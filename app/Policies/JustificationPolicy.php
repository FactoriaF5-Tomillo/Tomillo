<?php

namespace App\Policies;

use App\Justification;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

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
        return true;
    }

    public function create(User $user)
    {
        return true;
    }
    
    public function update(User $user, Justification $justification)
    {
        return $user->type === 'Teacher';
    }

}
