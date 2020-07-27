<?php

namespace Tests\Feature;

use App\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeacherTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_returns_teachers_list()
    {
        $teachers = factory(Teacher::class, 5)->create();

        $response = $this->get('/api/teachers');

        $response->assertStatus(200);
        $response->assertJsonCount(5);
    }

    public function test_api_returns_one_teacher()
    {
        $teacher = factory(Teacher::class)->create();

        $response = $this->get('/api/teachers/' . $teacher->id);

        $response->assertStatus(200);
        $response->assertJson([
            'name' => $teacher->name,
            'surname' => $teacher->surname,
            'email' => $teacher->email,
            'gender' => $teacher->gender,
        ]);
    }

    public function test_add_teacher_to_api()
    {
        $response = $this->post('/api/teachers', [
            'name' => 'Pau',
            'surname' => 'Gasol',
            'email' => 'paugasol@gmail.com',
            'gender' => 'hombre',
        ]);

        $this->assertDatabaseHas('teachers', [
            'name' => 'Pau',
            'surname' => 'Gasol',
            'email' => 'paugasol@gmail.com',
            'gender' => 'hombre',
        ]);
        $response->assertCreated();
    }

    public function test_edit_teacher()
    {
        $teacher = factory(Teacher::class)->create();

        $response = $this->patch('api/teachers/' . $teacher->id, [
            'name' => 'Pau',
            'surname' => 'Gasol',
            'email' => 'paugasol@gmail.com',
            'gender' => 'hombre',
        ]
        );
        $this->assertDatabaseHas('teachers', [
            'name' => 'Pau',
            'surname' => 'Gasol',
            'email' => 'paugasol@gmail.com',
            'gender' => 'hombre',
        ]
        );

        $response->assertStatus(302);
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
