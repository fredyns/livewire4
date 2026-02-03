<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        if ($user->hasRole(UserRole::SUPER_ADMIN->value)) {
            return true;
        }

        return $user->can('users.index');
    }

    public function view(User $user, User $model): bool
    {
        return $user->can('users.show');
    }

    public function create(User $user): bool
    {
        return $user->can('users.create');
    }

    public function update(User $user, User $model): bool
    {
        return $user->can('users.update');
    }

    public function delete(User $user, User $model): bool
    {
        return ($user->id != $model->id) && $user->can('users.delete');
    }

    public function restore(User $user, User $model): bool
    {
        if ($user->hasRole(UserRole::SUPER_ADMIN->value)) {
            return true;
        }

        return $user->can('users.delete');
    }

    public function forceDelete(User $user, User $model): bool
    {
        return ($user->id != $model->id) && $user->can('users.delete');
    }
}
