<?php

namespace App\Http\Resources;

use App\Course;
use Illuminate\Http\Resources\Json\JsonResource;

class Student extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'nationality' => $this->nationality,
            'email' => $this->email,
            'gender' => $this->gender,
            'course' => $this->course,
        ];
    }
}
