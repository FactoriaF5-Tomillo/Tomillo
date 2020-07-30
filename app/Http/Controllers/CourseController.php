<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\Course;
use App\Student;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function index()
    {
        $courses = Course::all();
        return view('course.index', compact('courses'));
    }

    public function getCourses()
    {
        $courses = Course::all();
        return $courses;
    }

    public function getCourse(Course $course)
    {
        return $course;
    }

    public function create()
    {
        return view('course.create');
    }

    public function store(Request $request)
    {
        $course = Course::create($request->all());
        return $course;
    }

    public function show(Course $course)
    {
        $students = Student::all();
        return view('course.show', compact('course', 'students'));
    }

    public function edit(Course $course)
    {
        return view('course.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $course->update($request->all());
        $courses = Course::all();
        return $courses;
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return Course::all();
    }

    public function chooseStudent(Course $course)
    {
        return view('course.chooseStudent', compact('course'));
    }
    public function addStudentToTheCourse(Request $request, Course $course)
    {
        $course = Course::find($request->course_id);
        $student = Student::find($request->student_id);
        $course->students()->save($student);
        //$course->students()->associate($student);
        //return redirect('/students');
        return $student;
    }

    public function addTeacherToTheCourse(Request $request)
    {

        $course = Course::find($request->course_id);

        $teacher = Teacher::find($request->course_id);

        $course->teachers()->attach($teacher);

        $courses = Course::all();
        return $course;
    }

    public function showAssignTeacher(Course $course)
    {
        return view('course.add_teacher', compact('course'));
    }
}

