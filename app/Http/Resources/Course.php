<?php

namespace App\Http\Resources;

use App\Http\Resources\Student as StudentResource;
use App\Http\Resources\Teacher as TeacherResource;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Course extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'users' => UserResource::collection($this->users),
        ];
    }
}
