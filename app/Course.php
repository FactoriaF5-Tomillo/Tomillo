<?php

namespace App;
use App\User;
//use DatePeriod;
//use DateInterval;
//use DateTime;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['title', 'description', 'start_date', 'end_date'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public static function getAllCourseStudents(Course $course)
    {
        $course_students = $course->users()->get();
        return $course_students;
    }
    public static function getAllCourseMaleStudents(Course $course)
    {
        $course_MaleStudents = $course->users()->where('gender', '=', 'Hombre')->get();

        return $course_MaleStudents;
    }

    public static function getAllCourseFemaleStudents(Course $course)
    {
        $course_FemaleStudents = $course->users()->where('gender', '=', 'Mujer')->get();

        return $course_FemaleStudents;
    }

    public static function getAllCourseOtherStudents(Course $course)
    {
        $course_FemaleStudents = $course->users()->where('gender', '=', 'Otro')->get();

        return $course_FemaleStudents;
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

    public function getRangeOfDates(){

        $begin= $this->start_date; //string
        $end= $this->end_date; //string

        $period = CarbonPeriod::create($begin, $end);

        // Iterate over the period
        foreach ($period as $date) {
            $date->format('Y-m-d');
        }

        // Convert the period to an array of dates
        $dates = $period->toArray();

        return $dates;
    }

    public static function excludeWeekendsFromRange(array $rangeOfDates){

        $OnlyWeekdays=array();
        foreach ($rangeOfDates as $date) {
            if($date->isWeekend()==False){
                array_push($OnlyWeekdays, $date);
            }
        }
        return $OnlyWeekdays;
    }
}
