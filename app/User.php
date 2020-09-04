<?php

namespace App;
use App\Course;
use App\Day;
use App\Justification;

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

    public function courses()
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


    public function age()
    {
        $timeSince = Carbon::parse($this->date_of_birth)->diff(Carbon::now());

        return $timeSince->format('%y');
    }

    public function studentCourse()
    {
        $student_course = $this->courses()->first();

        return $student_course;
    }

    public function teacherCourses()
    {
        $teacher_courses = $this->courses()->get();

        return $teacher_courses;
    }

    //Static functions
    public static function totalUsers()
    {
        $usersList = User::all();

        $numberOfUsers = count($usersList);

        return $numberOfUsers;
    }

    public static function totalStudents()
    {
        $studentsList = User::where('type', '=', 'Student')->get();

        $numberOfStudents = count($studentsList);

        return $numberOfStudents;
    }

    public static function totalMaleUsers()
    {
        $maleUsersList = User::where('gender', '=', 'Hombre')->get();

        $numberOfMaleUsers = count($maleUsersList);

        return $numberOfMaleUsers;
    }

    public static function totalFemaleUsers()
    {
        $femaleUsersList = User::where('gender', '=', 'Mujer')->get();

        $numberOfFemaleUsers = count($femaleUsersList);

        return $numberOfFemaleUsers;
    }

    public static function totalOtherUsers()
    {
        $otherUsersList = User::where('gender', '=', 'Otro')->get();

        $numberOfOtherUsers = count($otherUsersList);

        return $numberOfOtherUsers;
    }

    // when the user has no days assigned at all, the function and the test break because
    // $user->days does not exist until the first day assignment
    // when the user has no days assigned at all, the function and the test break because $user->days does not exist until the first day assignment
    public function addDayToUser($day)
    {
        //dd($this->days()->save($day));
        return $this->days()->save($day);
    }

    public function checkIfCanCheckIn()
    {
        if(count($this->days)!=0){
            if($this->days->last()->checkOut==null){
                return False;
            }
            return True;
        }
        return True;
    }
    public function calculateAssistedDays(){

        $assistedDays = $this->getAssistedDays();
        return count($assistedDays);
    }

    public function calculateAbsentDays(){

        $StudentCourse = $this->studentCourse();
        $courseDays = $StudentCourse->getCourseDaysUntilNow();
        $NumberOfCourseDays = count($courseDays);
        $assistedDays = $this->calculateAssistedDays();

        $absentDays = $NumberOfCourseDays-$assistedDays;

        return $absentDays;

    }

    public function calculateJustifiedDays(){

        $justifiedDays = $this->getJustifiedDays();
        return count($justifiedDays);
    }

    public function checkIfStudentHasCourse(){
        if($this->studentCourse() == null){
            return False;
        }
        return True;
    }

    public function getAssistedDays()
    {
        $StudentCourse = $this->studentCourse();
        $courseDays = $StudentCourse->getCourseDaysUntilNow(); //array of string type
        $checkedInDays = $this->days;

        $assistedDays = array();

        foreach ($courseDays as $courseDay){
            foreach ($checkedInDays as $checkedInDay){
                if ($courseDay==$checkedInDay->date){
                    array_push($assistedDays, $checkedInDay);
                }
            }
        }

        return $assistedDays;
    }

    public function getAbsentDays()
    {
        $studentCourse = $this->studentCourse();
        $courseDays = $studentCourse->getCourseDaysUntilNow(); //array of string type

        if(count($this->days) == 0){
            return $courseDays;
        }

        $checkedInDays = $this->days;

        $absentDays = [];

        foreach ($courseDays as $courseDay){
            foreach ($checkedInDays as $checkedInDay){
                if ($courseDay != $checkedInDay->date){
                    array_push($absentDays, $courseDay);
                }
            }
        }
        return $absentDays;
    }

    public function getJustifiedDays()
    { 
        $justifiedDays= array();

        foreach($this->justifications as $justification){
            if($justification->approval==True){
                $justificationRange = $justification->getJustificationDates();
                foreach($justificationRange as $justifiedDay){
                    array_push($justifiedDays, $justifiedDay);
                }

            }
        }
        return $justifiedDays;
    }
}

