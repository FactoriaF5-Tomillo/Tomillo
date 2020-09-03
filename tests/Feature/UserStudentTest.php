<?php

namespace Tests\Feature;

use App\User;
use App\Course;

use Carbon\Carbon;
use Carbon\CarbonPeriod;


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
    public function test_NotAdmin_Cant_creates_student()
    {
        $response = $this->post('/students', [
            'name' => 'Pau',
            'surname' => 'Gasol',
            'nationality' => 'spanish',
            'email' => 'paugasol@gmail.com',
            'gender' => 'hombre',
            'date_of_birth' => '2005-1-1'
        ]);

        $response->assertStatus(403);
        $response->assertSeeText('action is unauthorized');
    }

    public function test_admin_can_creates_student()
    {
        $admin = factory(User::class)->states('Admin')->create();
        $response = $this->actingAs($admin)->post('/students', [
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

    public function test_admin_can_edits_student()
    {
        $admin = factory(User::class)->states('Admin')->create();
        $student = factory(User::class)->states('Student')->create();
        $response = $this->actingAs($admin)->patch('/students/' . $student->id, [
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

    public function test_student_cant_delete_student()
    {
        $student = factory(User::class)->states('Student')->create();

        $response = $this->delete('/students/' . $student->id);

        $response->assertStatus(403);
        $response->assertSeeText('action is unauthorized');
    }
    public function test_admin_can_delete_student()
    {
        $admin = factory(User::class)->states('Admin')->create();
        $student = factory(User::class)->states('Student')->create();
        $response = $this->actingAs($admin)->delete('/students/' . $student->id);

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

    public function test_student_can_check_in()
    {
        $student = factory(User::class)->states('Student')->create();

        $course= Course::create([
            'title' => 'Web Development',
            'description' => 'Full-Stack training',
            'start_date' => date("2020-01-01"),
            'end_date' => date("2020-01-31")
        ]);

        $course->users()->save($student);

        $FakeToday = Carbon::create(2020, 1, 2, 12);
        Carbon::setTestNow($FakeToday);

        $response = $this->post('/api/students/' . $student->id . '/checkin');

        $response->assertStatus(201);

        $this->assertDatabaseHas('days', [
            'date' => date("2020-01-02"),
            'user_id' => $student->id
        ]);
    }

    public function test_student_cannot_check_in_when_it_is_not_a_course_day(){

        $student = factory(User::class)->states('Student')->create();

        $course= Course::create([
            'title' => 'Web Development',
            'description' => 'Full-Stack training',
            'start_date' => date("2020-01-01"),
            'end_date' => date("2020-01-31")
        ]);

        $course->users()->save($student);

        $FakeToday = Carbon::create(2020, 2, 1, 12);
        Carbon::setTestNow($FakeToday);

        $response = $this->post('/api/students/' . $student->id . '/checkin');

        $response->assertStatus(200);

        $this->assertDatabaseMissing('days', [
            'user_id' => $student->id,
        ]);
    }

    public function test_student_cannot_check_in_when_already_checked_in_on_the_same_day()
    {
        $student = factory(User::class)->states('Student')->create();

        $course= Course::create([
            'title' => 'Web Development',
            'description' => 'Full-Stack training',
            'start_date' => date("2020-01-01"),
            'end_date' => date("2020-01-31")
        ]);

        $course->users()->save($student);

        $FakeToday = Carbon::create(2020, 1, 2, 12);
        Carbon::setTestNow($FakeToday);

        $responseFirstCheckIn = $this->post('/api/students/' . $student->id . '/checkin');

        $responseSecondCheckIn = $this->post('/api/students/' . $student->id . '/checkin');

        $responseSecondCheckIn->assertStatus(200);
    }

    public function test_student_cannot_check_in_when_not_assigned_to_a_course()
    {
        $student = factory(User::class)->states('Student')->create();

        $course= Course::create([
            'title' => 'Web Development',
            'description' => 'Full-Stack training',
            'start_date' => date("2020-01-01"),
            'end_date' => date("2020-01-31")
        ]);

        $FakeToday = Carbon::create(2020, 1, 2, 12);
        Carbon::setTestNow($FakeToday);

        $response = $this->post('/api/students/' . $student->id . '/checkin');

        $response->assertStatus(200);

        $this->assertDatabaseMissing('days', [
            'date' => date("2020-01-02"),
            'user_id' => $student->id
        ]);
    }

    public function test_user_can_check_out()
    {
        $student = factory(User::class)->states('Student')->create();

        $course = Course::create([
            'title' => 'Web Development',
            'description' => 'Full-Stack training',
            'start_date' => date("2020-01-01"),
            'end_date' => date("2020-01-31")
        ]);

        $course->users()->save($student);

        $FakeTodayCourseDay = Carbon::create(2020, 1, 2, 12);
        Carbon::setTestNow($FakeTodayCourseDay);

        $responseCheckIn = $this->post('/api/students/' . $student->id . '/checkin');

        $responseCheckOut = $this->patch('/api/students/' . $student->id . '/checkout');

        $responseCheckOut->assertStatus(200);

        $this->assertDatabaseMissing('days', [
            'checkOut' => $FakeTodayCourseDay,
            'user_id' => $student->id
        ]);
    }

    public function test_student_cannot_check_out_when_not_checked_in()
    {
        $student = factory(User::class)->states('Student')->create();

        $course = Course::create([
            'title' => 'Web Development',
            'description' => 'Full-Stack training',
            'start_date' => date("2020-01-01"),
            'end_date' => date("2020-01-31")
        ]);

        $course->users()->save($student);

        $FakeTodayCourseDay = Carbon::create(2020, 1, 2, 12);
        Carbon::setTestNow($FakeTodayCourseDay);

        $responseCheckOut = $this->patch('/api/students/' . $student->id . '/checkout');

        $responseCheckOut->assertStatus(500);
    }

    public function test_student_cannot_check_out_when_already_checked_out()
    {
        $student = factory(User::class)->states('Student')->create();

        $course = Course::create([
            'title' => 'Web Development',
            'description' => 'Full-Stack training',
            'start_date' => date("2020-01-01"),
            'end_date' => date("2020-01-31")
        ]);

        $course->users()->save($student);

        $FakeTodayCourseDay = Carbon::create(2020, 1, 2, 12);
        Carbon::setTestNow($FakeTodayCourseDay);

        $responseCheckIn = $this->post('/api/students/' . $student->id . '/checkin');

        $responseCheckOut = $this->patch('/api/students/' . $student->id . '/checkout');

        $responseSecondCheckOut = $this->patch('/api/students/' . $student->id . '/checkout');

        $responseSecondCheckOut->assertStatus(200);
    }

}
