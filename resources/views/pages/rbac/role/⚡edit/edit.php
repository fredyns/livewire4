<?php

use App\Models\RBAC\Role;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

/**
 * @property Role $role The role instance
 * @property string $name
 */
new class extends Component
{
    #[Validate('required|string|min:3|max:255')]
    public string $name = '';

    public Role $role;

    /**
     * @throws AuthorizationException
     */
    public function mount(Role $role): void
    {
        $this->authorize('update', $role);

        $this->role = $role;
        $this->name = $role->name;
    }

    public function save(): void
    {
        try {
            $rules = [
                'name' => 'required|string|min:3|max:255|unique:rbac_roles,name,'.$this->role->id.',id,guard_name,'.$this->role->guard_name,
            ];

            $data = $this->validate($rules);

            Log::info('Updating role', [
                'role_id' => $this->role->id,
                'updated_by' => auth()->id(),
                'guard_name' => $this->role->guard_name,
            ]);

            $this->role->fill([
                'name' => $data['name'],
            ]);
            $this->role->save();

            session()->flash('message', 'Role updated successfully.');

            $this->redirectRoute('rbac.role.show', ['role' => $this->role]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation failed on role update', [
                'role_id' => $this->role->id,
                'errors' => $e->errors(),
            ]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error updating role', [
                'role_id' => $this->role->id,
                'error' => $e->getMessage(),
                'updated_by' => auth()->id(),
            ]);
            session()->flash('error', 'Failed to update role. Please try again.');
        }
    }

    public function render(): View
    {
        return $this->view([
            'role' => $this->role,
        ])->layout('layouts.app', ['sidebar' => 'user'])->title('Edit '.$this->role->name);
    }
};
