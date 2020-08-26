<?php

namespace Tests\Unit;

use App\Course;
use Tests\TestCase; //changed from PHPUnit
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Tests\Unit\Carbonite;

use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    public function test_convert_carbon_range_into_string_range(){

        $period = CarbonPeriod::create(date("2020-1-2"), date("2020-1-11"));
        $CarbonRange = $period->toArray();

        $StringRange = Course::convertCarbonRangeIntoStringRange($CarbonRange);

        $this->assertIsArray($StringRange);
        $this->assertIsString($StringRange[0]);
    }

    public function test_get_range_of_dates(){

        $start = date("2020-01-02");
        $end = date("2020-01-11");

        $course= Course::create([
            'title' => 'Web Development',
            'description' => 'Full-Stack training',
            'start_date' => $start,
            'end_date' => $end
        ]);

        $CourseDates = $course->getRangeOfDates();  //returns an array of Carbon Dates

        $dayInBetween = date("2020-01-04");
        $dayOutOfRange = date("2020-01-22");
        
        $this->assertIsArray($CourseDates);
        
        $StringRange = Course::convertCarbonRangeIntoStringRange($CourseDates);

        $this->assertContains($dayInBetween, $StringRange); 
        $this->assertNotContains($dayOutOfRange, $StringRange);
    }

    public function test_exclude_weekends_from_range_of_dates(){

        $period = CarbonPeriod::create(date("2020-1-1"), date("2020-1-11"));
        $rangeAllDates = $period->toArray();

        $StringRange = Course::convertCarbonRangeIntoStringRange($rangeAllDates);

        $Friday=date("2020-01-03");
        $Saturday=date("2020-01-04");

        $this->assertContains($Friday, $StringRange); 
        $this->assertContains($Saturday, $StringRange);

        $rangeWeekdaysOnly = Course::excludeWeekendsFromRange($rangeAllDates);

        $this->assertIsArray($rangeWeekdaysOnly);

        $StringRange = Course::convertCarbonRangeIntoStringRange($rangeWeekdaysOnly);

        $this->assertContains($Friday, $StringRange); 
        $this->assertNotContains($Saturday, $StringRange);

    }
}
