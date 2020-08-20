<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use App\Course;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserCourseTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_StudentUser_has_No_Course()
    {
        $user = factory(User::class)->create();
        $user_course = User::getActualCourse($user);
        $this->assertNull($user_course);
    }

    public function test_StudentUser_has_A_Course()
    {
        $user   = factory(User::class)->create();
        $course = factory(Course::class)->create();
        $user->course()->save($course);
        $user_course = User::getActualCourse($user);
        $this->assertNotNull($user_course);
    }
}
