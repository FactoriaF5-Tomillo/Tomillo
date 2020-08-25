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

    public static function getCourseMaleStudentsPercentage(Course $course)
    {
        $TotalCourseStudents = self::getAllCourseStudents($course);
        $MaleStudents = self::getAllCourseMaleStudents($course);
        $MalePercentage = ((count($MaleStudents))/(count($TotalCourseStudents)))*100;
        //dd($MalePercentage);
        return $MalePercentage;
    }

    public static function getCourseFemaleStudentsPercentage(Course $course)
    {
        $TotalCourseStudents = self::getAllCourseStudents($course);
        $FemaleStudents = self::getAllCourseFemaleStudents($course);
        $FemalePercentage = ((count($FemaleStudents))/(count($TotalCourseStudents)))*100;

        return $FemalePercentage;
    }

    public static function getCourseOtherStudentsPercentage(Course $course)
    {
        $TotalCourseStudents = self::getAllCourseStudents($course);
        $OtherStudents = self::getAllCourseOtherStudents($course);
        $OtherPercentage = ((count($OtherStudents))/(count($TotalCourseStudents)))*100;

        return $OtherPercentage;
    }
}
