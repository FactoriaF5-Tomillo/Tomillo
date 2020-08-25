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
    /*
    public function checkIfCheckedInSameDay(User $user){

        //$date = DB::table('days')->where('user_id', $user->id)->value('date');
        $dayToBeCheckedIn= $this->date->toDateString();
      
        foreach ($user->days as $dayUser){
            if (??==$dayToBeCheckedIn){
                
                return True;
            }
        }
        return False;

    }
    */


    

    

    

    
}
