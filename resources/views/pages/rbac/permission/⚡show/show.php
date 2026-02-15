<?php

use App\Models\RBAC\Permission;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

/**
 * @property Permission $permission The permission instance
 */
new class extends Component
{
    public Permission $permission;

    /**
     * @throws AuthorizationException
     */
    public function mount(Permission $permission): void
    {
        $this->authorize('view', $permission);
        $this->permission = $permission;

        Log::info('Viewing permission detail', ['permission_id' => $permission->id, 'viewed_by' => auth()->id()]);
    }

    #[Computed]
    public function rolesCount(): int
    {
        return $this->permission->roles()->count();
    }

    #[Computed]
    public function usersCount(): int
    {
        return $this->permission->users()->count();
    }

    /**
     * @throws AuthorizationException
     */
    public function delete(): void
    {
        try {
            $this->authorize('delete', $this->permission);

            Log::info('Deleting permission from show page', ['permission_id' => $this->permission->id, 'user_id' => auth()->id()]);

            DB::transaction(function () {
                $this->permission->roles()->detach();
                $this->permission->users()->detach();
                $this->permission->delete();
            });

            session()->flash('message', 'Permission deleted successfully.');
            $this->redirectRoute('rbac.permission.index');
        } catch (AuthorizationException $e) {
            Log::warning('Unauthorized delete attempt (permission show)', ['permission_id' => $this->permission->id, 'user_id' => auth()->id()]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error deleting permission (show page)', ['permission_id' => $this->permission->id, 'error' => $e->getMessage()]);
            session()->flash('error', 'Failed to delete permission.');
        }
    }

    public function render(): View
    {
        return $this->view([
            'permission' => $this->permission,
        ])->layout('layouts.app', ['sidebar' => 'apps'])->title($this->permission->name);
    }
};
