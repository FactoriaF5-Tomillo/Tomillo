<?php

namespace App;
use Carbon\Carbon;

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

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public static function setDate()
    {
        return Carbon::now();
    }

    private static function checkIn($date, $checkIn, $checkOut){

        $date=self::setDate();

        $day = Day::create([
            'date' => $date,
            'checkIn' => $date,
            'checkOut' => $date,
        ]);

        return $day;
    }
}
