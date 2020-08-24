<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Justification extends Model
{
    protected $fillable = ['file', 'description', 'approval', 'user_id'];

    public function user() 
    {
        return $this->belongsTo(User::class);  
    }
}
