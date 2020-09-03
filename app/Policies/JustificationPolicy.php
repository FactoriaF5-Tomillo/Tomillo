<?php

namespace App\Policies;

use App\Justification;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class JustificationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        if ($user->type === 'Admin' || $user->type === 'Teacher')
        {
            return true;
        }
        return false;
    }

    public function view(User $user, Justification $justification)
    {
        if ($user->type === 'Admin' || $user->type === 'Teacher' || $justification->user_id === $user->id)
        {
            return true;
        }
        return false;
    }

    public function create(User $user)
    {
        return $user->type === 'Student';
    }

    public function update(User $user, Justification $justification)
    {
        return $user->type === 'Teacher';
    }

}
