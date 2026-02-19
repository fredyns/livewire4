<?php

use App\Models\RBAC\Role;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    public User $user;

    public string $search = '';

    /**
     * @throws AuthorizationException
     */
    public function mount(User $user): void
    {
        $this->user = $user;
        $this->authorize('update', $user);
    }

    #[Computed]
    public function assignedRoleIds(): array
    {
        return $this->user->roles()->pluck('rbac_roles.id')->toArray();
    }

    #[Computed]
    public function availableRoles()
    {
        return Role::search($this->search)
            ->orderBy('guard_name')
            ->orderBy('name')
            ->get();
    }

    public function assignRole(string $roleId): void
    {
        try {
            $this->user->addRoleID($roleId);

            session()->flash('message', __('Role assigned successfully.'));
        } catch (\Exception $e) {
            Log::error('Error assigning role to user', [
                'user_id' => $this->user->id,
                'role_id' => $roleId,
                'error' => $e->getMessage(),
            ]);

            session()->flash('error', __('Failed to assign role.'));
        }
    }

    public function revokeRole(string $roleId): void
    {
        try {
            $this->user->removeRoleID($roleId);

            session()->flash('message', __('Role revoked successfully.'));
        } catch (\Exception $e) {
            Log::error('Error revoking role from user', [
                'user_id' => $this->user->id,
                'role_id' => $roleId,
                'error' => $e->getMessage(),
            ]);

            session()->flash('error', __('Failed to revoke role.'));
        }
    }

    public function render(): View
    {
        return $this->view([
            'user' => $this->user,
        ])->layout('layouts.app', ['sidebar' => 'user'])->title('Assign Roles');
    }
};
