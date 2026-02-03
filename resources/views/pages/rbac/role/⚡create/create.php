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
 * @property string $guardName
 */
new class extends Component
{
    #[Validate('required|string|min:3|max:255|unique:rbac_roles,name')]
    public string $name = '';

    #[Validate('required|string')]
    public string $guardName = AuthGuard::WEB->value;

    /**
     * @throws AuthorizationException
     */
    public function mount(): void
    {
        $this->authorize('create', Role::class);
    }

    #[Computed]
    public function guards()
    {
        return AuthGuard::cases();
    }

    public function save(): void
    {
        try {
            $data = $this->validate();

            if (! in_array($data['guardName'], AuthGuard::values())) {
                $this->guardName = AuthGuard::WEB->value;
                $data['guardName'] = $this->guardName;
            }

            Log::info('Creating new role', ['created_by' => auth()->id(), 'name' => $data['name'], 'guard_name' => $data['guardName']]);

            $role = Role::create([
                'name' => $data['name'],
                'guard_name' => $data['guardName'],
            ]);

            session()->flash('message', 'Role created successfully.');

            $this->redirectRoute('rbac.role.show', ['role' => $role]);
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
