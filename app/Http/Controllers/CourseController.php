<?php

namespace App\Http\Controllers;

use App\Course;
use App\Student;
use App\Teacher;
Use App\User;
use App\Http\Resources\Course as CourseResource;
//use Illuminate\Database\Eloquent\Collection::to_array();
use App\Policies\CoursePolicy;
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
        $courses = CourseResource::collection(Course::all());
        return $courses;
    }

    public function getCourse(Course $course)
    {
        return New CourseResource($course);
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
        $this->authorize('update', $course);
        return view('course.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        //$user = Auth::user();
        $this->authorize('update', $course);
        $course->update($request->all());
        $courses = Course::all();
        return $courses;
    }

    public function destroy(Course $course)
    {
        $this->authorize('delete', $course);
        $course->delete();
        return Course::all();
    }

    public function chooseStudent(Course $course)
    {
        return view('course.chooseStudent', compact('course'));
    }

    public function addStudentToTheCourse(Request $request, Course $course)
    {
        foreach ($request->students as $userId)
        {
            $user = User::find($userId);
            $user_course = User::getActualCourse($user);

            if ($user_course == null)
            {
                $course->users()->save($user);
            }
            continue;
        };

        return $course;
    }

    public function showStudents(Course $course)
    {
        $course = New CourseResource($course);
        return view('course.studentList', compact('course'));
    }

    public function showAssignTeacher(Course $course)
    {
        return view('course.add_teacher', compact('course'));
    }

    public function addTeacherToTheCourse(Request $request, Course $course)
    {
        foreach ($request->teachers as $userId)
        {
            $user = User::find($userId);
            $user_course = User::getAllTeacherCourses($user);

            if ($user_course->contains($course)) {
                continue;
            }
            $course->users()->attach($user);
        }

        return $course;
    }

    public function showTeachers(Course $course)
    {
        $course = New CourseResource($course);
        return view('course.teacherList', compact('course'));
    }
}
