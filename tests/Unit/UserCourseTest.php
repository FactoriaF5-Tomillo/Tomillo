<?php

namespace Tests\Unit;

use App\Course;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

// I don't think this a unit test
class UserCourseTest extends TestCase
{
    use RefreshDatabase;

    public function test_assign_course_to_student()
    {
        $user = factory(User::class)->create();
        $course = factory(Course::class)->create();

        $user->courses()->save($course);
        $user_course = $user->studentCourse();

        $this->assertNotNull($user_course);
        $this->assertEquals($user_course->id, $course->id);
    }
}
