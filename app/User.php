<?php

namespace App;
use App\Course;
use App\Day;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'name', 'surname', 'email', 'password', 'type', 'gender','nationality'
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

    public function justifications() {

        return $this->hasMany(Justification::class);
     }

     public static function getActualCourse(User $user)
     {
         $user_course = $user->course()->first();

         return $user_course;
     }

    public static function getAllTeacherCourses(User $user)
    {
        $user_courses = $user->course()->get();

        return $user_courses;
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
}
