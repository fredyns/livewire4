<?php

use App\Models\RBAC\Role;
use Illuminate\Auth\Access\AuthorizationException;
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

    public function render(): View
    {
        return $this->view([
            'role' => $this->role,
        ])->title($this->role->name);
    }
};
