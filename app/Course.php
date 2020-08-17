<?php

namespace App;
use App\Student;
use App\Teacher;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['title', 'description', 'start_date', 'end_date'];

    public function users()
    {
        return $this->hasMany(Student::class);
    }
}
