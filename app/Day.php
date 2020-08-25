<?php

namespace App;
use Carbon\Carbon;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{

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
        $date= Carbon::now()->setTimezone('Europe/Madrid');
        //->setTimezone('Europe/Madrid')->locale('es_ES')->isoFormat('M/D/YY');
        return $date;
    }

    public static function setTime()
    {
        $time = Carbon::now()->setTimezone('Europe/Madrid');
        //->setTimezone('Europe/Madrid')->isoFormat('HH:mm');
        return $time;

    }


    public static function checkIn(User $user){

        $date=self::setDate();
        $time=self::setTime();

        $day = Day::create([
            'date' => $date,
            'checkIn' => $time,
            'checkOut' => null,
        ]);

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

    public function checkIfCheckedInSameDay(){


    }

    public static function getTimeWorkedInADay()
    {
        $time=self::setTime();
        $hour = 8; $minute = 00; $second = 00; $tz = 'Europe/Madrid';
        $start = Carbon::createFromTime($hour, $minute, $second, $tz);
        $WorkedTimeDay = [];
        //dd($time->diffForHumans($start));
        //dd($time->diff($start)->format('%H:%I:%S'));
        $diffInHours = $time->diffInHours($start);
        array_push($WorkedTimeDay, $diffInHours);

        $diffInMinutes = $time->diffInMinutes($start);
        array_push($WorkedTimeDay, $diffInMinutes);

        //dd($WorkedTimeDay);
        return $WorkedTimeDay;
    }







}
