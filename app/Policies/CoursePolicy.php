<?php

namespace App\Policies;

use App\Course;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
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

    public function view(User $user, Course $course)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->type === 'Admin';
    }

    public function update(User $user, Course $course)
    {
        return $user->type === 'Admin';
    }

    public function delete(User $user, Course $course)
    {
        return  $user->type === 'Admin';
    }

    public function restore(User $user, Course $course)
    {
        //
    }

}
