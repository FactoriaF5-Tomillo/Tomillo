<?php

namespace Tests\Feature;

use App\Course;
use App\User;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class CourseTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_returns_list_of_courses()
    {
        $course = factory(Course::class, 4)->create();

        $response = $this->get('/api/courses');

        $response->assertStatus(200);
        $response->assertJsonCount(4);
    }

    public function test_api_stores_course()
    {
        $response = $this->post('/courses', [
            'title' => 'Full Stack',
            'description' => 'Better boot-camp',
            'start_date' => '27-07-2020',
            'end_date' => '14-4-2021',
        ]);

        $this->assertDatabaseHas('courses', [
            'title' => 'Full Stack',
            'description' => 'Better boot-camp',
            'start_date' => '27-07-2020',
            'end_date' => '14-4-2021',
        ]);

        $response->assertCreated();
        $response->assertStatus(201);
    }

    public function test_edits_course_when_user_is_admin()
    {
        $user = factory(User::class)->states('Admin')->create();
        $course = factory(Course::class)->create();

        $response = $this->actingAs($user)->patch('/courses/' . $course->id, [
            'title' => 'Full Stack',
            'description' => 'Better boot-camp',
            'start_date' => '27-07-2020',
            'end_date' => '14-4-2021',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('courses', [
            'title' => 'Full Stack',
            'description' => 'Better boot-camp',
            'start_date' => '27-07-2020',
            'end_date' => '14-4-2021',
        ]);
    }

    public function test_edits_course_unauthorized_when_user_is_not_admin()
    {
        $user = factory(User::class)->states('Teacher')->create();
        $course = factory(Course::class)->create();

        $response = $this->actingAs($user)->patch('/courses/' . $course->id, [
            'title' => 'Full Stack',
            'description' => 'Better boot-camp',
            'start_date' => '27-07-2020',
            'end_date' => '14-4-2021',
        ]);

        $response->assertStatus(403);
    }

    public function test_course_delete_when_user_is_admin()
    {
        $user = factory(User::class)->states('Admin')->create();
        $course = factory(Course::class)->create();

        $response = $this->actingAs($user)->delete('/courses/' . $course->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('courses', [
            'title' => $course->title,
            'description' => $course->description,
            'start_date' => $course->start_date,
            'end_date' => $course->end_date,
        ]);
    }

    public function test_course_delete_unauthorized_when_user_is_not_admin()
    {
        $user = factory(User::class)->states('Teacher')->create();
        $course = factory(Course::class)->create();

        $response = $this->actingAs($user)->delete('/courses/' . $course->id);

        $response->assertStatus(403);
    }

    public function test_add_student_to_course()
    {
        $course = factory(Course::class)->create();
        $student = factory(User::class)->create();

        $response = $this->post('/courses/' . $course->id . '/addStudentToTheCourse', ["students"=>[$student->id]]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('course_user', [
            'course_id' => $course->id,
            'user_id' => $student->id
        ]);
    }
}
