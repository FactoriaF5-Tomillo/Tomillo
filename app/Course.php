<?php

namespace App;
use App\User;


use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['title', 'description', 'start_date', 'end_date'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
