<?php

namespace App;
use Carbon\Carbon;
use App\User;
use App\Course;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    const MinutesInHour = 60;
    protected $fillable = ['date', 'checkIn', 'checkOut'];

    /*
    private function __construct($date, $checkIn, $checkOut){

        $this->date = Carbon::now();
        $this->checkIn = Carbon::now();
        $this->checkOut = $checkOut;
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function setDate()
    {
        $date= Carbon::now()->setTimezone('Europe/Madrid')->toDateString();

        var_dump($date);
        //->setTimezone('Europe/Madrid')->locale('es_ES')->isoFormat('M/D/YY');
        return $date;
    }

    public static function setTime()
    {
        $time = Carbon::now()->setTimezone('Europe/Madrid');
        //->setTimezone('Europe/Madrid')->isoFormat('HH:mm');
        return $time;

    }

    public static function checkIn(User $user)
    {

        //check if user has a course assigned.

        //check if today corresponds to user's course dates.

        $date=self::setDate(); //string

        $time=self::setTime();

        $day = Day::create([
            'date' => $date,
            'checkIn' => $time,
            'checkOut' => null,
        ]);

        if($day->checkIfCheckedInSameDay($user)){
            $day->forceDelete();
            return null;
        }

        $user->addDayToUser($day);

        return $day;
    }

    public function checkOut(){

        $time=self::setTime();

        if($this->checkIfCheckedOut()){
            return $this;
        }

        $this->update(array('checkOut' => $time));

        return $this;
    }

    public function checkIfCheckedOut(){

        if($this->checkOut==null){
            return False;
        }
        return True;
    }

    public function checkIfCheckedInSameDay(User $user)
    {
        foreach ($user->days as $dayUser){
            //var_dump($this->date);
            //var_dump($dayUser->date);
            if ($dayUser->date==$this->date){
                return True;
            }
        }
        return False;
    }


    public static function getTimeWorkedInADay($day)
    {
        $diffInHours = $day->checkOut->diffInHours($day->checkIn);
        $diffInMinutes = $day->checkOut->diffInMinutes($day->checkIn);
        $minutes = $diffInMinutes % Day::MinutesInHour;
        $WorkedTimeDay = ['Hours'=> $diffInHours, 'Minutes'=> $minutes];

        return $WorkedTimeDay;
    }

    public static function getWorkedHoursOfAStudentInACourse($days)
    {
        $totalHours   = 0;
        $totalMinutes = 0;
        foreach ($days as $day)
        {
            $timeDiff= self::getTimeWorkedInADay($day);
            $totalHours  = $totalHours + $timeDiff['Hours'];
            $totalMinutes= $totalMinutes +$timeDiff['Minutes'];
            $Minutes = $totalMinutes % Day::MinutesInHour;
        }
        $TotalWorkedTimeCourse = ['Hours'=> $totalHours, 'Minutes'=> $Minutes];

        return $TotalWorkedTimeCourse;
    }
    public static function checkIfTodayCorrespondsCourseDates(Course $course){

        $date=self::setDate(); //string

        $courseDays = $course->getCourseDaysUntilNow(); //array of strings

        foreach ($courseDays as $courseDay){
            if ($courseDay == $date){
                return True;
            }
        }
        return False;

    
    }

}
