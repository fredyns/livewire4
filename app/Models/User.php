<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\AuthGuard;
use App\Enums\UserRole;
use App\Helpers\S3;
use App\Models\RBAC\Role;
use App\Models\Traits\ModelDocBlocks;
use App\Models\Traits\Searchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $profile_picture_hd
 * @property string $profile_picture_thumbnail
 * @property string $storage_dir
 * @property Carbon $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property-read Carbon|null $created_at
 * @property-read Carbon|null $updated_at
 * @property-read Role[] $roles
 * @property-read Role[] $webRoles
 */
class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    use HasRoles;
    use HasUuids;
    use ModelDocBlocks;
    use Notifiable;
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture_hd',
        'profile_picture_thumbnail',
    ];

    protected array $searchableFields = [
        'name',
        'email',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function storageDir(): string
    {
        if (empty($this->storage_dir)) {
            $idWithoutDash = str_replace('-', '', $this->id);
            $firstSegment = substr($idWithoutDash, 0, 8);
            $secondSegment = substr($idWithoutDash, 8);
            $this->storage_dir = "users/{$firstSegment}/{$secondSegment}";
            $this->saveQuietly();
        }

        return $this->storage_dir;
    }

    /**
     * Get the HD profile picture (1024x1024) URL from S3
     */
    public function profilePictureHdUrl(): ?string
    {
        return S3::url($this->profile_picture_hd);
    }

    /**
     * Get the thumbnail profile picture (128x128) URL from S3
     */
    public function profilePictureThumbnailUrl(): ?string
    {
        return S3::url($this->profile_picture_thumbnail);
    }

    /**
     * Check if user has a profile picture
     */
    public function hasProfilePicture(): bool
    {
        return ! empty($this->profile_picture_hd) && ! empty($this->profile_picture_thumbnail);
    }

    /**
     * Get user's notifications
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'notifiable_id')
            ->where('notifiable_type', self::class);
    }

    /**
     * Get user's notification preferences
     */
    public function notificationPreferences(): HasMany
    {
        return $this->hasMany(NotificationPreference::class);
    }

    /**
     * @param  string[]|UserRole[]  $roles
     */
    public function addRoleNames(array $roles): void
    {
        foreach ($roles as $role) {
            $this->addRoleName($role);
        }
    }

    public function addRoleName(UserRole|string $role): void
    {
        if ($role instanceof UserRole) {
            $role = $role->value;
        }

        foreach (AuthGuard::values() as $guardName) {
            $role = Role::findOrCreate($role, $guardName);
            $this->addRole($role);
        }
    }

    public function addRoleID(string $roleID): void
    {
        $role = Role::find($roleID);
        if ($role) {
            $this->addRole($role);
        }
    }

    public function addRole(Role $role): void
    {
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');
        $pivotRole = $columnNames['role_pivot_key'] ?? 'role_id';
        $modelKey = $columnNames['model_morph_key'] ?? 'model_id';

        $exists = DB::table($tableNames['model_has_roles'])
            ->where($pivotRole, $role->id)
            ->where('model_type', User::class)
            ->where($modelKey, $this->id)
            ->exists();

        if (! $exists) {
            DB::table($tableNames['model_has_roles'])->insert([
                'id' => Str::uuid(),
                $pivotRole => $role->id,
                'model_type' => User::class,
                $modelKey => $this->id,
            ]);
        }
    }

    /**
     * @param  UserRole[]|string[]  $roles
     */
    public function removeRoleNames(array $roles): void
    {
        foreach ($roles as $role) {
            $this->removeRoleName($role);
        }
    }

    public function removeRoleName(UserRole|string $role): void
    {
        if ($role instanceof UserRole) {
            $role = $role->value;
        }

        $roles = Role::where('name', $role)->get();
        if ($roles->count() > 0) {
            foreach ($roles as $role) {
                $this->removeRole($role);
            }
        }
    }

    public function removeRoleID(string $roleID): void
    {
        $role = Role::find($roleID);
        if ($role) {
            $this->removeRole($role);
        }
    }

    public function removeRole(Role $role): void
    {
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');
        $pivotRole = $columnNames['role_pivot_key'] ?? 'role_id';
        $modelKey = $columnNames['model_morph_key'] ?? 'model_id';

        DB::table($tableNames['model_has_roles'])
            ->where($pivotRole, $role->id)
            ->where('model_type', User::class)
            ->where($modelKey, $this->id)
            ->delete();
    }

    /**
     * A model may have multiple roles.
     */
    public function webRoles(): BelongsToMany
    {
        return $this->roles()->where('guard_name', 'web');
    }

    /**
     * A model may have multiple roles.
     */
    public function apiRoles(): BelongsToMany
    {
        return $this->roles()->where('guard_name', 'sanctum');
    }
}
