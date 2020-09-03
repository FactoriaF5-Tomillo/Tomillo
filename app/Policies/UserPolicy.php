<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        if ($user->type === 'Admin')
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        if ($user->id === $model->id || $user->type === 'Admin')
        {
            return true;
        }
        return false;
    }

    public function viewProfile(User $user, User $model)
    {
        if ($user->id === $model->id)
        {
            return true;
        }
        return false;
    }

    public function create(User $user)
    {
        if ($user->type === 'Admin')
        {
            return true;
        }
        return false;
    }

    public function update(User $user, User $model)
    {
        if ($user->type === 'Admin' || $user->id === $model->id)
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        if ($user->type === 'Admin')
        {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        //
    }
}
