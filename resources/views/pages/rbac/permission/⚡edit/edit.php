<?php

use App\Models\RBAC\Permission;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

/**
 * @property Permission $permission The permission instance
 * @property string $name
 */
new class extends Component
{
    #[Validate('required|string|min:3|max:255')]
    public string $name = '';

    public Permission $permission;

    /**
     * @throws AuthorizationException
     */
    public function mount(Permission $permission): void
    {
        $this->authorize('update', $permission);

        $this->permission = $permission;
        $this->name = $permission->name;
    }

    public function save(): void
    {
        try {
            $rules = [
                'name' => 'required|string|min:3|max:255|unique:rbac_permissions,name,'.$this->permission->id.',id,guard_name,'.$this->permission->guard_name,
            ];

            $data = $this->validate($rules);

            Log::info('Updating permission', [
                'permission_id' => $this->permission->id,
                'updated_by' => auth()->id(),
                'guard_name' => $this->permission->guard_name,
            ]);

            $this->permission->fill([
                'name' => $data['name'],
            ]);
            $this->permission->save();

            session()->flash('message', 'Permission updated successfully.');

            $this->redirectRoute('rbac.permission.show', ['permission' => $this->permission]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation failed on permission update', [
                'permission_id' => $this->permission->id,
                'errors' => $e->errors(),
            ]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error updating permission', [
                'permission_id' => $this->permission->id,
                'error' => $e->getMessage(),
                'updated_by' => auth()->id(),
            ]);
            session()->flash('error', 'Failed to update permission. Please try again.');
        }
    }

    public function render(): View
    {
        return $this->view([
            'permission' => $this->permission,
        ])->layout('layouts.app', ['sidebar' => 'apps'])->title('Edit '.$this->permission->name);
    }
};
