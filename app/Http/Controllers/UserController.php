<?php

namespace App\Http\Controllers;



use App\User;
use App\Day;
use App\Http\Resources\User as UserResource;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;


class UserController extends Controller
{
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

    public function getLoggedUser()
    {
        $loggeduser = Auth::user();
        $user = User::find($loggeduser->id);
        return $user;
    }
    public function getTeachers()
    {
        $teachers = UserResource::collection(User::where('type', 'Teacher')->get());
        return $teachers;
    }

    public function getTeacher(User $user)
    {
        return new UserResource($user);
    }

    public function getStudents()
    {
        $students = UserResource::collection(User::where('type', 'Student')->get());
        return $students;
    }

    public function getAvailableStudents()
    {
        $students = User::where('type', 'Student')->get();

        $availableStudents = [];

        foreach($students as $student) {
            if(count($student->course) == 0) {
                array_push($availableStudents, $student);
            }
        }

        return UserResource::collection($availableStudents);
    }

    public function getStudent(User $user)
    {
        return new UserResource($user);
    }

    public function createTeacher()
    {
        return view('teacher.create');
    }

    public function createStudent()
    {
        return view('student.create');
    }

    public function storeStudent(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'type' => 'Student',
            'gender' => $request->gender,
            'nationality' => $request->nationality,
            'password' => Hash::make('password')
        ]);
        return $user;
    }

    public function storeTeacher(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'type' => 'Teacher',
            'gender' => $request->gender,
            'password' => Hash::make('password')
        ]);
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

    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();
        return User::all();
    }

    public function checkIn(User $user){
       
        return Day::checkIn($user);
    }
}
