<?php

namespace App\Policies\Sample;

use App\Models\Sample\SampleItem;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SampleItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the record can view the model.
     */
    public function view(User $user, SampleItem $model): bool
    {
        return true;
    }

    /**
     * Determine whether the record can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the record can update the model.
     */
    public function update(User $user, SampleItem $model): bool
    {
        return true;
    }

    /**
     * Determine whether the record can delete the model.
     */
    public function delete(User $user, SampleItem $model): bool
    {
        return true;
    }

    /**
     * Determine whether the record can restore the model.
     */
    public function restore(User $user, SampleItem $model): bool
    {
        return false;
    }
}
