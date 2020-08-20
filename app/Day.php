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
        $date= Carbon::now();
        //->setTimezone('Europe/Madrid')->locale('es_ES')->isoFormat('M/D/YY'); 
        return $date;
    }

    public static function setTime()
    {
        $time = Carbon::now();
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

    

    

    

    
}
