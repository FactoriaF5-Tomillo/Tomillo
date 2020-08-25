<?php

namespace Tests\Feature;

use App\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserStudentTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_returns_students_list()
    {
        $students = factory(User::class, 5)->states('Student')->create();

        $response = $this->get('/api/students');
        $response->assertJsonCount(5);
    }

    public function test_api_returns_single_student()
    {
        $students = factory(User::class, 5)->states('Student')->create();
        $student = factory(User::class)->states('Student')->create();

        $response = $this->get('/api/students/' . $student->id);

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $student->id
        ]);
    }

    public function test_api_creates_student()
    {
        $response = $this->post('/api/students', [
            'name' => 'Pau',
            'surname' => 'Gasol',
            'nationality' => 'spanish',
            'email' => 'paugasol@gmail.com',
            'gender' => 'hombre',
            'date_of_birth' => '2005-1-1'
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', [
            'name' => 'Pau',
            'surname' => 'Gasol',
            'nationality' => 'spanish',
            'email' => 'paugasol@gmail.com',
            'gender' => 'hombre',
            'date_of_birth' => '2005-1-1',
            'type' => 'Student'
        ]);
    }

    public function test_api_edits_student()
    {
        $student = factory(User::class)->states('Student')->create();

        $response = $this->patch('api/students/' . $student->id, [
            'name' => 'Pau',
            'surname' => 'Gasol',
            'nationality' => 'spanish',
            'email' => 'paugasol@gmail.com',
            'gender' => 'hombre',
            'date_of_birth' => '2005-1-1'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'name' => 'Pau',
            'surname' => 'Gasol',
            'nationality' => 'spanish',
            'email' => 'paugasol@gmail.com',
            'gender' => 'hombre',
            'date_of_birth' => '2005-1-1'
        ]);
    }

    public function test_delete_student()
    {
        $student = factory(User::class)->states('Student')->create();

        $response = $this->delete('/api/students/' . $student->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('students', [
            'name' => $student->name,
            'surname' => $student->surname,
            'nationality' => $student->nationality,
            'email' => $student->email,
            'gender' => $student->gender,
            'date_of_birth' => $student->date_of_birth
        ]);
    }
}
