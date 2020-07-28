<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

    public function index()
    {
        $teachers = Teacher::all();
        return view('teacher.index', compact('teachers'));
    }

    public function getTeachers()
    {
        $teachers = Teacher::all();
        return $teachers;
    }

    public function getTeacher(Teacher $teacher)
    {
        return $teacher;
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $teacher = Teacher::create($request->all());
        return $teacher;
    }

    public function show(Teacher $teacher)
    {
        return view('teacher.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        return view('teacher.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $teacher->update($request->all());
        $teachers = Teacher::all();
        return $teachers;
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return Teacher::all();
    }
}
