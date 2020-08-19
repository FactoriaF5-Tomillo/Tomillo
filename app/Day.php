<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $fillable = ['date', 'check-in', 'check-out'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
