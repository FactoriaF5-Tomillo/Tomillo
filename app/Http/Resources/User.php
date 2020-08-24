<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if($this->type == "Student") {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'surname' => $this->surname,
                'email' => $this->email,
                'type' => $this->type,
                'gender' => $this->gender,
                'nationality' => $this->nationality,
                'age' => $this->age(),
                'date_of_birth' => $this->date_of_birth,
                'course' => $this->studentCourse(),
                'email_verified_at' => $this->email_verified_at,
                'password' => $this->password
            ];
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
            'type' => $this->type,
            'gender' => $this->gender,
            'nationality' => $this->nationality,
            'age' => $this->age(),
            'date_of_birth' => $this->date_of_birth,
            'course' => $this->course,
            'email_verified_at' => $this->email_verified_at,
            'password' => $this->password
        ];
    }
}
