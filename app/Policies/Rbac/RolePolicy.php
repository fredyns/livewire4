<?php

namespace App\Policies\Rbac;

use App\Enums\UserRole;
use App\Models\RBAC\Role;
use App\Models\User;

class RolePolicy
{
    /**
     * Determine whether the user can view any roles.
     */
    public function viewAny(User $user): bool
    {
        if ($user->hasRole(UserRole::SUPER_ADMIN->value)) {
            return true;
        }

        return $user->can('rbac.roles.index');
    }

    /**
     * Determine whether the user can view the role.
     */
    public function view(User $user, Role $role): bool
    {
        if ($user->hasRole(UserRole::SUPER_ADMIN->value)) {
            return true;
        }

        if ($user->hasRole($role->name)) {
            return true;
        }

        return $user->can('rbac.roles.show');
    }

    /**
     * Determine whether the user can create roles.
     */
    public function create(User $user): bool
    {
        if ($user->hasRole(UserRole::SUPER_ADMIN->value)) {
            return true;
        }

        return $user->can('rbac.roles.create');
    }

    /**
     * Determine whether the user can update the role.
     */
    public function update(User $user, Role $role): bool
    {
        if ($user->hasRole(UserRole::SUPER_ADMIN->value)) {
            return true;
        }

        if ($role->isProtected()) {
            return false;
        }

        return $user->can('rbac.roles.update');
    }

    /**
     * Determine whether the user can delete the role.
     */
    public function delete(User $user, Role $role): bool
    {
        // Prevent deletion of roles that have users assigned
        if ($role->users()->count() > 0) {
            return false;
        }

        if ($user->hasRole(UserRole::SUPER_ADMIN->value)) {
            return true;
        }

        return $user->can('rbac.roles.delete');
    }
}
