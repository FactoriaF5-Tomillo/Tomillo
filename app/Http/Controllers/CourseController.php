<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        return view('course.create');
    }

    public function store(Request $request)
    {
        Course::create($request->all());

    }

    public function show(Course $course)
    {
        //
    }


    public function edit(Course $course)
    {
        //
    }

    public function update(Request $request, Course $course)
    {
        //
    }

    public function destroy(Course $course)
    {
        //
    }
}
