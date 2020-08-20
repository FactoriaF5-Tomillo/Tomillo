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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function setDate()
    {

        return Carbon::now()->format('Y-m-d H:i:s');
        
    }

    private static function checkIn(){

        $date=self::setDate();

        $day = Day::create([
            'date' => $date,
            'checkIn' => $date,
            'checkOut' => $date,
        ]);

        return $day;
    }
}
