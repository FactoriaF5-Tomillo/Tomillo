<?php

namespace Tests\Unit;

use App\Course;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StadisticsTest extends TestCase
{
    use RefreshDatabase;

    //This test is redundent. The function returns a number, if its 0 its 0 if its 10 its 10. Behaviour doesnt change
    public function test_no_students_in_db()
    {
        $Admin_Users = factory(User::class, 5)->states('Admin')->create();
        $Teacher_Users = factory(User::class, 5)->states('Teacher')->create();

        $type = 'Student';
        $Total_Student_Users = User::getTotalStudentUsers($type);

        $this->assertEquals(0, $Total_Student_Users);
    }

    // test si hay alumnos en la base de datos
    public function test_user_table_is_not_empty()
    {
        $users = factory(User::class, 15)->create();

        $totalUsers = User::getTotalUsers();

        $this->assertEquals(count($users), $totalUsers);
    }

    //calcular el total de alumnos hombres
    public function test_total_male_users()
    {
        $maleUsers= factory(User::class, 15)->create(['gender'=>'Hombre']);
        $femaleUsers= factory(User::class, 15)->create(['gender'=>'Mujer']);

        $gender = 'Hombre';
        $totalMaleUsers = User::getTotalMaleUsers($gender);

        $this->assertEquals(count($maleUsers), $totalMaleUsers);
        $totalUsers = User::getTotalUsers();
        $this->assertEquals(30, $totalUsers);
    }

    //calcular el total de alumnos mujeres
    public function test_Total_Female_Users()
    {
        $Male_Users= factory(User::class, 15)->create(['gender'=>'Hombre']);
        $Female_Users= factory(User::class, 15)->create(['gender'=>'Mujer']);

        $gender = 'Mujer';
        $Total_Female_Users = User::getTotalFemaleUsers($gender);

        $this->assertEquals(count($Female_Users), $Total_Female_Users);
        $Total_Users = User::getTotalUsers();
        $this->assertEquals(30, $Total_Users);
    }

    //calcular el total de alumnos otros
    public function test_total_other_users()
    {
        $Male_Users= factory(User::class, 15)->create(['gender'=>'Hombre']);
        $Female_Users= factory(User::class, 15)->create(['gender'=>'Mujer']);
        $Other_Users= factory(User::class, 15)->create(['gender'=>'Otro']);

        $gender = 'Otro';
        $Total_Other_Users = User::getTotalOtherUsers($gender);

        $this->assertEquals(count($Other_Users), $Total_Other_Users);
        $Total_Users = User::getTotalUsers();
        $this->assertEquals(45, $Total_Users);
    }

    public function test_Return_All_Course_Users()
    {
        $course = factory(Course::class)->create();
        $users  = factory(User::class, 10)->create(['type' => 'Student']);

        foreach ($users as $user)
        {
            $course->users()->attach($user);
        }
        $course_students = Course::getAllCourseStudents($course);
        $this->assertEquals(10, count($course_students));
    }

    public function test_Return_Male_Students_Percentatge()
    {
        $course = factory(Course::class)->create();
        $MaleStudents  = factory(User::class, 10)->create(['type' => 'Student', 'gender'=>'Hombre']);
        $FemaleStudents  = factory(User::class, 10)->create(['type' => 'Student', 'gender'=>'Mujer']);
        $students = User::all();
        //dd(count($students));
        foreach ($students as $student)
        {
            $course->users()->attach($student);
        }

        $MalePercentage = Course::getCourseMaleStudentsPercentage($course);

        $this->assertEquals(50, $MalePercentage);
    }

    public function test_Return_Female_Students_Percentatge()
    {
        $course = factory(Course::class)->create();
        $MaleStudents   = factory(User::class, 10)->create(['type' => 'Student', 'gender'=>'Hombre']);
        $FemaleStudents = factory(User::class, 10)->create(['type' => 'Student', 'gender'=>'Mujer']);
        $OtherStudents  = factory(User::class, 5)->create(['type' => 'Student', 'gender'=>'Otro']);
        $students = User::all();

        foreach ($students as $student)
        {
            $course->users()->attach($student);
        }

        $FemalePercentage = Course::getCourseFemaleStudentsPercentage($course);

        $this->assertEquals(40, $FemalePercentage);
    }

    public function test_Return_Other_Students_Percentatge()
    {
        $course = factory(Course::class)->create();
        $MaleStudents   = factory(User::class, 10)->create(['type' => 'Student', 'gender'=>'Hombre']);
        $FemaleStudents = factory(User::class, 10)->create(['type' => 'Student', 'gender'=>'Mujer']);
        $OtherStudents  = factory(User::class, 5)->create(['type' => 'Student', 'gender'=>'Otro']);
        $students = User::all();

        foreach ($students as $student)
        {
            $course->users()->attach($student);
        }

        $OtherPercentage = Course::getCourseOtherStudentsPercentage($course);

        $this->assertEquals(20, $OtherPercentage);
    }
}
