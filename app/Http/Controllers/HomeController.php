<?php

namespace App\Http\Controllers;

use App\Course;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function homeindex()
    {
        $loggeduser = Auth::user();
        $user = User::find($loggeduser->id);

        if($loggeduser->type == 'Admin')
        {
            $courses = Course::all();
            return view('course.index', compact('courses'));
        }
        if($loggeduser->type == 'Teacher')
        {
            return view('teacher.show', compact('user'));
        }
        if($loggeduser->type == 'Student')
        {
            return view('studentProfile', compact('user'));
        }
    }

    public function coursesindex()
    {

    }
}
