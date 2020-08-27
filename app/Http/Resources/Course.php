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

    private function studentsGenderMale()
    {
        $students = [];

        foreach($this->users as $user) {
            if($user->gender === "Male") {
                array_push($students, $user);
            }
        }

        return $students;
    }

    private function studentsGenderFemale()
    {
        $students = [];

        foreach($this->users as $user) {
            if($user->gender === "Female") {
                array_push($students, $user);
            }
        }

        return $students;
    }

    private function studentsGenderOthers()
    {
        $students = [];

        foreach($this->users as $user) {
            if($user->gender === "Others") {
                array_push($students, $user);
            }
        }

        return $students;
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
            'teachers' => UserResource::collection($this->teachers()),
            'totalStudents' => $this->totalStudents(),
            'totalMaleStudents' => $this->totalMaleStudents(),
            'totalFemaleStudents' => $this->totalFemaleStudents(),
            'totalOtherStudents' => $this->totalOtherStudents(),
            'malePercentage' => $this->malePercentage(),
            'femalePercentage' => $this->femalePercentage(),
            'otherPercentage' => $this->otherPercentage(),
        ];
    }
}
