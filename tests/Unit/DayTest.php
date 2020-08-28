<?php

namespace Tests\Unit;


use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Day;
use App\User;
use App\Course;


class DayTest extends TestCase
{
    use RefreshDatabase;

    public function test_set_date()
    {
        $date = Day::setDate();
        $this->assertNotNull($date);
    }

    public function test_set_time()
    {
        $time = Day::setTime();
        $this->assertNotNull($time);
    }

    public function test_student_can_check_in()
    {
        $user= factory(User::class)->create();

        $day= Day::checkIn($user);

        $this->assertNotNull($day);

        $this->assertNotNull($day->date);
        $this->assertNotNull($day->checkIn);
        $this->assertEquals($user->id, $day->user_id);

        // dd($user->days);
        //$this->assertEquals($user->days[0], $day);
    }

    public function test_check_out()
    {
        $user = factory(User::class)->create();
        $day = Day::checkIn($user);

        $day->checkout();

        $this->assertNotNull($day->checkOut);
    }

    public function test_check_if_user_checked_out(){

        $user = factory(User::class)->create();
        $day = Day::checkIn($user);

        $this->assertFalse($day->checkIfCheckedOut());

        $day->checkOut();

        $this->assertTrue($day->checkIfCheckedOut());

    }

    public function test_check_if_checked_in_same_day()
    {
        $user = factory(User::class)->create();

        $assignedDay = factory(Day::class)->create();//creates a day instance of today
        $user->addDayToUser($assignedDay); //assigns the day to user

        $dayToCompare = factory(Day::class)->create(); //another day instance of today, not assigned

        /*
        $anotherDay = Day::create([
            'date' => '2021-03-03'
        ]);
        */

        //when we try to reach the days field of user before assigning any day by check-in, the user object anull itself

        $check1 = $dayToCompare->checkIfCheckedInSameDay($user);
        //$check2 = $$anotherDay->checkIfCheckedInSameDay($user);

        $this->assertTrue($check1);
        //$this->assertTrue($check2);
    }

    public function test_time_worked_in_a_day()
    {
        $hour = 8; $minute = 00; $second = 00; $tz = 'Europe/Madrid';
        $start = Carbon::createFromTime($hour, $minute, $second, $tz);
        $time = Carbon::now()->setTimezone('Europe/Madrid');
        $day = factory(Day::class)->create(['checkIn'=> $start, 'checkOut'=> $time]);
        $workedtimeinDay = Day::getTimeWorkedInADay($day);

        $HourRightNow = Carbon::now()->setTimezone('Europe/Madrid')->hour;
        $MinutesRightNow = Carbon::now()->setTimezone('Europe/Madrid')->minute;

        $HoursPassedSinceStart   = $HourRightNow - $hour;
        $MinutesPassedSinceStart = $MinutesRightNow;

        $this->assertEquals($HoursPassedSinceStart, $workedtimeinDay['Hours']);
        $this->assertEquals($MinutesPassedSinceStart, $workedtimeinDay['Minutes']);
    }

    public function test_time_worked_in_a_course()
    {
        $starthour = 8; $startminute = 00; $startsecond = 00; $tz = 'Europe/Madrid';
        $start = Carbon::createFromTime($starthour, $startminute, $startsecond, $tz);
        $endhour = 16; $endminute = 30; $endsecond = 00;
        $time = Carbon::createFromTime($endhour, $endminute, $endsecond, $tz);
        $days = [];
        $day1 = factory(Day::class)->create(['date'=>"2020-01-01", 'checkIn' => $start, 'checkOut' => $time]);
        array_push($days, $day1);
        $day2 = factory(Day::class)->create(['date'=>"2020-01-02", 'checkIn' => $start, 'checkOut' => $time]);
        array_push($days, $day2);
        $day3 = factory(Day::class)->create(['date'=>"2020-01-03", 'checkIn' => $start, 'checkOut' => $time]);
        array_push($days, $day3);
        $totalWorkedTimeInCourse = Day::getWorkedHoursOfAStudentInACourse($days);
        //$this->assertNotNull($totalHoursInCourse);
        $this->assertEquals(24, $totalWorkedTimeInCourse['Hours']);
        $this->assertEquals(30, $totalWorkedTimeInCourse['Minutes']);
    }

    public function test_check_if_today_corresponds_course_dates(){

        $course = Course::create([
            'title' => 'Web Development',
            'description' => 'Full-Stack training',
            'start_date' => date("2020-01-01"),
            'end_date' => date("2020-01-31")
        ]);

        $FakeTodayNoCourseDay = Carbon::create(2020, 6, 1, 12);          
        Carbon::setTestNow($FakeTodayNoCourseDay); 

        $check1 = Day::checkIfTodayCorrespondsCourseDates($course);
        $this->assertFalse($check1);

        $FakeTodayCourseDay = Carbon::create(2020, 1, 2, 12);          
        Carbon::setTestNow($FakeTodayCourseDay); 

        $check2 = Day::checkIfTodayCorrespondsCourseDates($course);
        $this->assertTrue($check2);

    }

    
}
