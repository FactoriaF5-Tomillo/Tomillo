<?php

namespace App\Http\Controllers;

use App\Course;
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
        return view('course.show', compact('course'));
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
}
