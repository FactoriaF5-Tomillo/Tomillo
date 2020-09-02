<?php

namespace App\Policies;

use App\Course;
use App\User;
use Hamcrest\Arrays\IsArrayContaining;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
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

    public function view(User $user, Course $course)
    {
        $courseUsers = $course->users()->get();
        $numUsers = intval(count($courseUsers));
        if ($numUsers > 0)
        {
            foreach ($courseUsers as $courseUser)
            {
                if ($courseUser->id === $user->id)
                {
                    return true;
                }
                return false;
            }
            return false;
        }
        if ($user->type === 'Admin')
        {
            return true;
        }
        return false;
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
