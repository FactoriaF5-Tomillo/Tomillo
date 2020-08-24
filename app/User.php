<?php

namespace App;
use App\Course;
use App\Day;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'name', 'surname', 'email', 'password', 'type', 'gender', 'nationality', 'date_of_birth'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function course()
    {
        return $this->belongsToMany(Course::class);
    }

    public function days()
    {
        return $this->hasMany(Day::class);
    }

    public function justifications()
    {
        return $this->hasMany(Justification::class);
    }

    public function studentCourse()
    {
        $student_course = $this->course()->first();

        return $student_course;
    }

    public function teacherCourses()
    {
        $teacher_courses = $this->course()->get();

        return $teacher_courses;
    }

    public function addDayToUser($day)
    {
        //dd($this->days()->save($day));
        return $this->days()->save($day);
    }


    public static function getTotalStudentUsers($type)
    {
        $Student_Users = User::where('type', '=', $type)->get();
        return count($Student_Users);
    }

    public static function getTotalMaleUsers($gender)
    {
        $Male_Users = User::where('gender', '=', $gender)->get();
        return count($Male_Users);
    }

    public static function getTotalFemaleUsers($gender)
    {
        $Female_Users = User::where('gender', '=', $gender)->get();
        return count($Female_Users);
    }

    public static function getTotalOtherUsers($gender)
    {
        $Other_Users = User::where('gender', '=', $gender)->get();
        return count($Other_Users);
    }

    public static function getTotalUsers()
    {
        $Total_Users = User::all();
        return count($Total_Users);
    }

    public function age()
    {
        $timeSince = Carbon::parse($this->date_of_birth)->diff(Carbon::now());

        return $timeSince->format('%y');

    }
}
