<?php

namespace App\Http\Resources;

use App\Http\Resources\Student as StudentResource;
use App\Http\Resources\Teacher as TeacherResource;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Course extends JsonResource
{
    private function students()
    {
        $students = [];

        foreach($this->users as $user) {
            if($user->type === "Student") {
                array_push($students, $user);
            }
        }

        return $students;
    }

    private function teachers()
    {
        $teachers = [];

        foreach($this->users as $user) {
            if($user->type === "Teacher") {
                array_push($teachers, $user);
            }
        }

        return $teachers;
    }

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'students' => UserResource::collection($this->students()),
            'teachers' => UserResource::collection($this->teachers())

        ];
    }
}
