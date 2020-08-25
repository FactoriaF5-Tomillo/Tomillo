<?php

namespace Tests\Feature;

use App\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTeacherTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_returns_teachers_list()
    {
        $users = factory(User::class, 5)->states('Teacher')->create();

        $response = $this->get('/api/teachers');

        $response->assertStatus(200);
        $response->assertJsonCount(5);
    }

    public function test_api_returns_single_teacher()
    {
        $teacher = factory(User::class)->states('Teacher')->create();

        $response = $this->get('/api/teachers/' . $teacher->id);

        $response->assertStatus(200);
        $response->assertJson([
            'name' => $teacher->name,
            'surname' => $teacher->surname,
            'email' => $teacher->email,
            'gender' => $teacher->gender,
        ]);
    }

    public function test_api_create_teacher()
    {
        $teacher = [
            'name' => 'Pau',
            'surname' => 'Gasol',
            'email' => 'paugasol@gmail.com',
            'gender' => 'hombre',
        ];

        $response = $this->post('/api/teachers', $teacher);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', $teacher);
    }

    public function test_api_edit_teacher()
    {
        $teacher = factory(User::class)->create();

        $response = $this->patch('api/teachers/' . $teacher->id, [
            'name' => 'Pau',
            'surname' => 'Gasol',
            'email' => 'paugasol@gmail.com',
            'gender' => 'hombre',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'name' => 'Pau',
            'surname' => 'Gasol',
            'email' => 'paugasol@gmail.com',
            'gender' => 'hombre',
        ]);
    }

    public function test_api_delete_teacher()
    {
        $teacher = factory(User::class)->create();

        $response = $this->delete('/api/teachers/' . $teacher->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('teachers', [
            'id' => $teacher->id,
            'name' => $teacher->name,
            'surname' => $teacher->surname,
            'nationality' => $teacher->nationality,
            'email' => $teacher->email,
            'gender' => $teacher->gender,
        ]);
    }
}
