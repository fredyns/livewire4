<?php

namespace App\Models\Sample;

use App\Enums\Sample\SampleItemEnumerate;
use App\Helpers\JsonField;
use App\Models\Traits\Creator;
use App\Models\Traits\ModelDocBlocks;
use App\Models\Traits\Searchable;
use App\Models\Traits\StorageDir;
use App\Models\Traits\Updater;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

/**
 * This is the model class for table "sample_items".
 *
 * @property string $id
 * @property string $string
 * @property string|null $user_id
 * @property SampleItemEnumerate|null $enumerate
 * @property string|null $text
 * @property string|null $email
 * @property string|null $npwp
 * @property string|null $color
 * @property int|null $integer
 * @property float|null $decimal
 * @property Carbon|null $datetime
 * @property Carbon|null $date
 * @property Carbon|null $time
 * @property string|null $ip_address
 * @property bool|null $boolean
 * @property string|null $file
 * @property string|null $image
 * @property string|null $wysiwyg
 * @property float|null $latitude
 * @property float|null $longitude
 * @property array|null $json
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $storage_dir
 * @property-read Carbon|null $created_at
 * @property-read Carbon|null $updated_at
 * @property User|null $user
 */
class SampleItem extends Model
{
    use Creator;
    use HasFactory;
    use HasUuids;
    use ModelDocBlocks;
    use Searchable;
    use StorageDir;
    use Updater;

    protected $fillable = [
        'user_id',
        'string',
        'email',
        'color',
        'ip_address',
        'integer',
        'decimal',
        'npwp',
        'datetime',
        'date',
        'time',
        'boolean',
        'enumerate',
        'text',
        'file',
        'image',
        'wysiwyg',
        'latitude',
        'longitude',
    ];

    protected array $searchableFields = [
        'string',
        'email',
        'color',
        'text',
    ];

    protected $casts = [
        'datetime' => 'datetime',
        'date' => 'date',
        'time' => 'datetime:H:i:s',
        'boolean' => 'boolean',
        'json' => 'array',
        'enumerate' => SampleItemEnumerate::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function json($key = null, $default = null)
    {
        return JsonField::getField($this, 'json', $key, $default);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Delete uploaded files associated with this item
     */
    public function deleteUploadedFiles(): void
    {
        foreach (['file', 'image'] as $field) {
            if ($this->{$field}) {
                Storage::delete($this->{$field});
            }
        }
    }
}
