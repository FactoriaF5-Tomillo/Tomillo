<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if ($user->type === 'Admin')
        {
            return true;
        }
        return false;
    }

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

    public function delete(User $user, User $model)
    {
        if ($user->id != $model->id || $user->type === 'Admin')
        {
            return true;
        }
        return false;
    }

    public function restore(User $user, User $model)
    {
        //
    }
}
