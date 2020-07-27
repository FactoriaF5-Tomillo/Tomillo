<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

    public function index()
    {
        //
    }

    public function getTeachers()
    {
        $teachers = Teacher::all();
        return $teachers;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $teacher = Teacher::create($request->all());
        return $teacher;
    }

    public function show(Teacher $teacher)
    {
        //
    }

    public function edit(Teacher $teacher)
    {
        //
    }

    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    public function destroy(Teacher $teacher)
    {
        //
    }
}
