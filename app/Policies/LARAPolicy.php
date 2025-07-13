<?php

namespace App\Policies;

use App\Models\LARA;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LARAPolicy
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
     * Determine whether the user can view the model.
     */
    public function view(User $user, LARA $lara): bool
    {
        return $user->id === $lara->pemilik_id || 
               ($user->email === $lara->recipient_email && $lara->is_released);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, LARA $lara): bool
    {
        return $user->id === $lara->pemilik_id && !$lara->is_released;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, LARA $lara): bool
    {
        return $user->id === $lara->pemilik_id && !$lara->is_released;
    }
}
