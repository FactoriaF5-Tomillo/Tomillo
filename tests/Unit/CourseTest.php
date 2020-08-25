<?php

namespace Tests\Unit;

use App\Course;
use Tests\TestCase; //changed from PHPUnit
use Carbon\Carbon;
use Carbon\CarbonPeriod;

use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_range_of_dates(){

        $start = date("2020-1-1");
        $end = date("2020-1-11");

        $course= Course::create([
            'title' => 'Web Development',
            'description' => 'Full-Stack training',
            'start_date' => $start,
            'end_date' => $end
        ]);
       // buraya kadar iyi dd($course); 

        $dayInBetween = Carbon::create(2020, 1, 7);
        $dayOutOfRange = Carbon::create(2021, 05, 03);
        
        $range = $course->getRangeOfDates();

        $this->assertIsArray($range);
        //$this->assertContains($dayInBetween, $range); //Farklı objeler
        $this->assertNotContains($dayOutOfRange, $range);
    }

    public function test_exclude_weekends_from_range_of_dates(){

        $start = date("2020-1-1");
        $end = date("2020-1-11");

        $period = CarbonPeriod::create($start, $end);
        $range = $period->toArray();


        $rangeWeekdaysOnly = Course::excludeWeekendsFromRange($range);

        $this->assertIsArray($rangeWeekdaysOnly);

    }
}
