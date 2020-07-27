<?php

namespace Tests\Feature;

use App\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use RefreshDatabase;

    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_access_api()
    {
        $response = $this->get('/api/students');

        $response->assertStatus(200);
    }

    public function test_api_returns_students_list()
    {
        $student = factory(Student::class, 5)->create();

        $response = $this->get('/api/students');
        $response->assertJsonCount(5);
    }

    public function test_add_student_to_api()
    {

        $response = $this->post('/api/students', [
            'name' => 'Pau',
            'surname' => 'Gasol',
            'nationality' => 'spanish',
            'email' => 'paugasol@gmail.com',
            'gender' => 'hombre',
            'currentcourse' => 'gimnasia',
        ]
        );

        $this->assertDatabaseHas('students', [
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

    public function test_edit_student()
    {
        $student = factory(Student::class)->create();

        $response = $this->patch('api/students/' . $student->id, [
            'name' => 'Pau',
            'surname' => 'Gasol',
            'nationality' => 'spanish',
            'email' => 'paugasol@gmail.com',
            'gender' => 'hombre',
            'currentcourse' => 'gimnasia',
        ]
        );
        $this->assertDatabaseHas('students', [
            'name' => 'Pau',
            'surname' => 'Gasol',
            'nationality' => 'spanish',
            'email' => 'paugasol@gmail.com',
            'gender' => 'hombre',
            'currentcourse' => 'gimnasia',
        ]
        );
        $response->assertStatus(302);
        $response->assertRedirect('students');
    }

    public function test_delete_student()
    {
        $student = factory(Student::class)->create();

        $response = $this->delete('/api/students/' . $student->id);

        $this->assertDatabaseMissing('students', [
            'name' => $student->name,
            'surname' => $student->surname,
            'nationality' => $student->nationality,
            'email' => $student->email,
            'gender' => $student->gender,
            'currentcourse' => $student->currentcourse,

        ]);
        $response->assertStatus(200);
    }
}
