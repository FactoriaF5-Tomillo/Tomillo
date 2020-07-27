<?php

namespace Tests\Feature;

use App\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeacherTest extends TestCase
{
    use RefreshDatabase;

    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_access_api()
    {
        $response = $this->get('/api/teachers');

        $response->assertStatus(200);
    }

    public function test_api_returns_teachers_list()
    {
        $Teacher = factory(Teacher::class, 5)->create();

        $response = $this->get('/api/teachers');
        $response->assertJsonCount(5);
    }

    public function test_add_teacher_to_api()
    {

        $response = $this->post('/api/teachers', [
            'name' => 'Pau',
            'surname' => 'Gasol',
            'nationality' => 'spanish',
            'email' => 'paugasol@gmail.com',
            'gender' => 'hombre',
            'currentcourse' => 'gimnasia',
        ]
        );

        $this->assertDatabaseHas('teachers', [
            'name' => 'Pau',
            'surname' => 'Gasol',
            'nationality' => 'spanish',
            'email' => 'paugasol@gmail.com',
            'gender' => 'hombre',
            'currentcourse' => 'gimnasia',
        ]
        );
        $response->assertCreated();
    }

    public function test_edit_teacher()
    {
        $teacher = factory(Teacher::class)->create();

        $response = $this->patch('api/teachers/' . $teacher->id, [
            'name' => 'Pau',
            'surname' => 'Gasol',
            'nationality' => 'spanish',
            'email' => 'paugasol@gmail.com',
            'gender' => 'hombre',
            'currentcourse' => 'gimnasia',
        ]
        );
        $this->assertDatabaseHas('teachers', [
            'name' => 'Pau',
            'surname' => 'Gasol',
            'nationality' => 'spanish',
            'email' => 'paugasol@gmail.com',
            'gender' => 'hombre',
            'currentcourse' => 'gimnasia',
        ]
        );
        $response->assertStatus(302);
        $response->assertRedirect('teachers');
    }

    public function test_delete_teacher()
    {
        $teacher = factory(Teacher::class)->create();

        $response = $this->delete('/api/teachers/' . $teacher->id);

        $this->assertDatabaseMissing('teachers', [
            'name' => $teacher->name,
            'surname' => $teacher->surname,
            'nationality' => $teacher->nationality,
            'email' => $teacher->email,
            'gender' => $teacher->gender,
            'currentcourse' => $teacher->currentcourse,

        ]);
        $response->assertStatus(200);
    }
}
