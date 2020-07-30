<?php

namespace App;
use App\Course;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'email',
        'gender',
    ];
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
