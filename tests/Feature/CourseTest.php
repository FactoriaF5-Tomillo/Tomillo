<?php

namespace Tests\Feature;

use App\Course;
use App\User;
use App\Http\Controllers\CourseController;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class CourseTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_returns_courses_list()
    {
        $course = factory(Course::class, 4)->create();

        $response = $this->get('/api/courses');

        $response->assertStatus(200);
        $response->assertJsonCount(4);
    }

    public function test_api_creates_course()
    {
        $response = $this->post('/api/courses', [
            'title' => 'Full Stack',
            'description' => 'Better boot-camp',
            'start_date' => '27-07-2020',
            'end_date' => '14-4-2021',
        ]
        );

        $this->assertDatabaseHas('courses', [
            'title' => 'Full Stack',
            'description' => 'Better boot-camp',
            'start_date' => '27-07-2020',
            'end_date' => '14-4-2021',
        ]
        );
        $response->assertCreated();
        $response->assertStatus(201);
    }


    //Middleware not working. Admin has no authorization to edit
    public function test_api_edits_course()
    {
        $course = factory(Course::class)->create();

        $response = $this->patch('api/courses/' . $course->id, [
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

    //Need to mock a user somehow
    public function test_api_deletes_course()
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

    public function test_add_student_to_course()
    {
        $course = factory(Course::class)->create();
        $student = factory(User::class)->create();

        $response = $this->post('api/courses/' . $course->id . '/addStudentToTheCourse', ["students"=>[$student->id]]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('course_user', [
            'course_id' => $course->id,
            'user_id' => $student->id
        ]);
    }
}
