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
        return view('/students');
    }

    public function create()
    {
        return view('create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Student $student)
    {
        //
    }


    public function edit(Student $student)
    {
        //
    }


    public function update(Request $request, Student $student)
    {
        //
    }


    public function destroy(Student $student)
    {
        //
    }
}
