<?php

namespace App;
use App\Student;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['title', 'description', 'start_date', 'end_date'];

    public function students()
    {
        return $this->hasMany('Student');
    }
    public function teachers()
    {
        return $this->belongsToMany('Teacher');
    }
}
