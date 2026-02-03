<?php

use App\Enums\AuthGuard;
use App\Models\RBAC\Role;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

/**
 * @property string $name
 * @property string[] $guardNames
 */
new class extends Component
{
    #[Validate('required|string|min:3|max:255')]
    public string $name = '';

    /**
     * @var string[]
     */
    public array $guardNames = [];

    /**
     * @throws AuthorizationException
     */
    public function mount(): void
    {
        $this->authorize('create', Role::class);

        $this->guardNames = AuthGuard::values();
    }

    #[Computed]
    public function guards()
    {
        return AuthGuard::cases();
    }

    public function save(): void
    {
        try {
            $data = $this->validate([
                'name' => 'required|string|min:3|max:255',
                'guardNames' => 'required|array|min:1',
                'guardNames.*' => 'required|string|in:'.implode(',', AuthGuard::values()),
            ]);

            $created = 0;

            foreach ($data['guardNames'] as $guardName) {
                $exists = Role::query()
                    ->where('name', $data['name'])
                    ->where('guard_name', $guardName)
                    ->exists();

                if ($exists) {
                    continue;
                }

                Role::create([
                    'name' => $data['name'],
                    'guard_name' => $guardName,
                ]);

                $created++;
            }

            Log::info('Creating new roles', [
                'created_by' => auth()->id(),
                'name' => $data['name'],
                'guards' => $data['guardNames'],
                'created_count' => $created,
            ]);

            if ($created === 0) {
                session()->flash('error', 'No roles were created (they may already exist).');
                return;
            }

            session()->flash('message', $created === 1 ? 'Role created successfully.' : "{$created} roles created successfully.");

            $this->redirectRoute('rbac.role.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation failed on role creation', ['errors' => $e->errors()]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error creating role', ['error' => $e->getMessage(), 'created_by' => auth()->id()]);
            session()->flash('error', 'Failed to create role. Please try again.');
        }
    }

    public function render(): View
    {
        return $this->view()->title('Create Role');
    }
};
