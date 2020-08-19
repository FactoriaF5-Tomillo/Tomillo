<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexTeacher()
    {
        $teachers = User::where('type', 'Teacher')->get();
        return view('teacher.index', compact('teachers'));

    }

    public function indexStudent()
    {
        $students = User::where('type', 'Student')->get();
        return view('student.index', compact('students'));
    }



    public function getTeachers()
    {
        $teachers = User::where('type', 'Teacher')->get();
        return $teachers;
    }

    public function getTeacher(User $user)
    {
        return $user;
    }
    public function getStudents()
    {
        $students = User::where('type', 'Student')->get();
        return $students;
    }
    public function getStudent(User $user)
    {
        return $user;
    }

    public function createTeacher()
    {
        return view('teacher.create');
    }
    public function createStudent()
    {
        return view('student.create');
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        return $user;
    }

    public function showStudent(User $user)
    {
        return view('student.show', compact('user'));
        
    }
    public function showTeacher(User $user)
    {
        return view('teacher.show', compact('user'));
    }

    public function editStudent(User $user)
    {
        return view('student.edit', compact('user'));
    }

    public function editTeacher(User $user)
    {
        return view('teacher.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        $users = User::all();
        return $users;
    }

    public function destroy(User $user)
    {
        $user->delete();
        return User::all();
    }
}
