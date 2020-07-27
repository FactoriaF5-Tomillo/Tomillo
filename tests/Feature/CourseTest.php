<?php

namespace Tests\Feature;

use App\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class CourseTest extends TestCase
{
    use RefreshDatabase;

    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_access_api()
    {
        $response = $this->get('/api/courses');

        $response->assertStatus(200);
    }

    public function test_api_returns_courses_list()
    {
        $course = factory(Course::class, 4)->create();


        $response = $this->get('/api/courses');
        $response-> assertJsonCount(4);
    }

    public function test_add_course_to_api()
    {

        $response = $this->post('/api/courses',[
                'title'         => 'Full Stack',
                'description'   => 'Better boot-camp',
                'start_date'    => '27-07-2020',
                'end_date'      => '14-4-2021'
            ]
        );

        $this->assertDatabaseHas('courses', [
                'title'         => 'Full Stack',
                'description'   => 'Better boot-camp',
                'start_date'    => '27-07-2020',
                'end_date'      => '14-4-2021'
            ]
        );
        $response->assertCreated();
        $response->assertStatus(201);
    }

    public function test_edit_student()
    {
        $course = factory(Course::class)->create();

        $response = $this->patch('api/courses/'.$course->id,[
                'title'         => 'Full Stack',
                'description'   => 'Better boot-camp',
                'start_date'    => '27-07-2020',
                'end_date'      => '14-4-2021'
            ]
        );
        $this->assertDatabaseHas('courses', [
                'title'         => 'Full Stack',
                'description'   => 'Better boot-camp',
                'start_date'    => '27-07-2020',
                'end_date'      => '14-4-2021'
            ]
        );
        $response->assertStatus(302);
        $response->assertRedirect('courses');
    }

    public function test_delete_course()
    {
        $course = factory(Course::class)->create();

        $response = $this->delete('/api/courses/' . $course->id);

        $this->assertDatabaseMissing('courses', [
            'title'        => $course->title,
            'description'  => $course->description,
            'start_date'   => $course->start_date,
            'end_date'     => $course->end_date,
        ]);
        $response->assertStatus(200);
    }
}

