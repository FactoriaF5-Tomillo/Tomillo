<?php

namespace App;
use App\Course;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'surname', 'nationality', 'email', 'gender', 'currentcourse'];

    public function course()
    {
        return $this->belongsTo('Course');
    }
}
