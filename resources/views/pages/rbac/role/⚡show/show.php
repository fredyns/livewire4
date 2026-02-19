<?php

use App\Models\RBAC\Role;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

/**
 * @property Role $role The role instance
 */
new class extends Component
{
    public Role $role;

    /**
     * @throws AuthorizationException
     */
    public function mount(Role $role): void
    {
        $this->authorize('view', $role);
        $this->role = $role;

        Log::info('Viewing role detail', ['role_id' => $role->id, 'viewed_by' => auth()->id()]);
    }

    #[Computed]
    public function permissions()
    {
        return $this->role->permissions()->get();
    }

    #[Computed]
    public function groupedPermissions()
    {
        $grouped = [];

        foreach ($this->permissions as $permission) {
            $parts = explode('.', $permission->name);
            $action = array_pop($parts);
            $controller = implode('.', $parts) ?: 'global';
            $key = $controller;

            if (! isset($grouped[$key])) {
                $grouped[$key] = [
                    'controller' => $controller,
                    'actions' => [],
                ];
            }

            $grouped[$key]['actions'][] = $action;
        }

        ksort($grouped);
        foreach ($grouped as &$group) {
            sort($group['actions']);
        }

        return $grouped;
    }

    /**
     * @throws AuthorizationException
     */
    public function delete(): void
    {
        try {
            $this->authorize('delete', $this->role);

            Log::info('Deleting role from show page', ['role_id' => $this->role->id, 'user_id' => auth()->id()]);

            DB::transaction(function () {
                $this->role->permissions()->detach();
                $this->role->delete();
            });

            session()->flash('message', 'Role deleted successfully.');
            $this->redirectRoute('rbac.role.index');
        } catch (AuthorizationException $e) {
            Log::warning('Unauthorized delete attempt (show page)', ['role_id' => $this->role->id, 'user_id' => auth()->id()]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error deleting role (show page)', ['role_id' => $this->role->id, 'error' => $e->getMessage()]);
            session()->flash('error', 'Failed to delete role.');
        }
    }

    public function render(): View
    {
        return $this->view([
            'role' => $this->role,
        ])->layout('layouts.app', ['sidebar' => 'user'])->title($this->role->name);
    }
};
