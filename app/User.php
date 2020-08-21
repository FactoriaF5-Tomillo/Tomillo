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

    public function addDayToUser($day){

        return $this->days()->save($day);
    }

    /* when the user has no days assigned at all, the function and the test break because $user->days does not exist until the first day assignment 
    public function checkIfCanCheckIn()
    {

        if($this->days!=null){
            if($this->days->last()->checkOut==null){
                return False;
            }
            return True;
        }
        return True;
        
        
    }
    */
}

