<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view('student.index', compact('students'));
    }

    public function getStudents()
    {
        $students = Student::all();
        return $students;
    }
    public function getStudent(Student $student)
    {
        return $student;
    }
    public function create()
    {
        return view('student.create');
    }


    public function store(Request $request)
    {
        $student = Student::create($request->all());
        //return redirect('/api/students');
        return $student;
    }


    public function show(Student $student)
    {
        return view('student.show', compact('student'));

    }


    public function edit(Student $student)
    {
        return view('student.edit', compact('student'));
    }


    public function update(Request $request, Student $student)
    {
        $student->update($request->all());
        $students = Student::all();
        return redirect(route('student.index', compact('students')));
    }


    public function destroy(Student $student)
    {
        $student->delete();
        return redirect('/student');
    }
}
