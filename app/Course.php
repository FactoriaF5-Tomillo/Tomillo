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

    public function totalStudents()
    {
        $listOfStudents = $this->users()->where('type', '=', 'Student')->get();

        $totalNumberOfStudents = count($listOfStudents);

        return $totalNumberOfStudents;
    }

    public function totalMaleStudents()
    {
        $listOfStudents = $this->users()->where('gender', '=', 'Hombre')->get();

        $totalNumberOfMaleStudents = count($listOfStudents);

        return $totalNumberOfMaleStudents;
    }

    public function totalFemaleStudents()
    {
        $listOfStudents = $this->users()->where('gender', '=', 'Mujer')->get();

        $totalNumberOfFemaleStudents = count($listOfStudents);

        return $totalNumberOfFemaleStudents;
    }

    public function totalOtherStudents()
    {
        $listOfStudents = $this->users()->where('gender', '=', 'Otro')->get();

        $totalNumberOfOtherStudents = count($listOfStudents);

        return $totalNumberOfOtherStudents;
    }

    public function malePercentage()
    {
        $totalStudents = $this->totalStudents();
        $totalMaleStudents = $this->totalMaleStudents();

        $malePercentage = ($totalMaleStudents / $totalStudents) * 100;

        return intval($malePercentage);
    }

    public function femalePercentage()
    {
        $totalStudents = $this->totalStudents();
        $totalFemaleStudents = $this->totalFemaleStudents();

        $femalePercentage = ($totalFemaleStudents / $totalStudents) * 100;

        return intval($femalePercentage);
    }

    public function otherPercentage()
    {
        $totalStudents = $this->totalStudents();
        $totalOtherStudents = $this->totalOtherStudents();

        $otherPercentage = ($totalOtherStudents / $totalStudents) * 100;

        return intval($otherPercentage);
    }
}
