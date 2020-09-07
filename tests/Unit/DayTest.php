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
    const hour = 8; const minute = 00; const second = 0; const tz = 'Europe/Madrid';
    const endhour = 16; const endminute = 30; const endsecond = 0;

    public function test_sets_date()
    {
        $date = Day::setDate();
        $this->assertNotNull($date);
    }

    public function test_sets_time()
    {
        $time = Day::setTime();
        $this->assertNotNull($time);
    }

    public function test_check_in()
    {
        $student= factory(User::class)->create();

        $course = Course::create([
            'title' => 'Web Development',
            'description' => 'Full-Stack training',
            'start_date' => date("2020-01-01"),
            'end_date' => date("2020-01-31")
        ]);

        $course->users()->save($student);

        $FakeTodayCourseDay = Carbon::create(2020, 1, 2, 12);
        Carbon::setTestNow($FakeTodayCourseDay);

        $day= Day::checkIn($student);

        $this->assertNotNull($day);

        $this->assertNotNull($student->days);
        $this->assertNotNull($day->date);
        $this->assertNotNull($day->checkIn);
        $this->assertEquals($student->id, $day->user_id);
    }

    public function test_check_out()
    {
        $student = factory(User::class)->create();

        $course = Course::create([
            'title' => 'Web Development',
            'description' => 'Full-Stack training',
            'start_date' => date("2020-01-01"),
            'end_date' => date("2020-01-31")
        ]);

        $course->users()->save($student);

        $FakeTodayCourseDay = Carbon::create(2020, 1, 2, 12);
        Carbon::setTestNow($FakeTodayCourseDay);

        $day = Day::checkIn($student);

        $day->checkout();

        $this->assertNotNull($day->checkOut);
    }

    public function test_checks_if_user_checked_out(){

        $student = factory(User::class)->create();

        $course = Course::create([
            'title' => 'Web Development',
            'description' => 'Full-Stack training',
            'start_date' => date("2020-01-01"),
            'end_date' => date("2020-01-31")
        ]);

        $course->users()->save($student);

        $FakeTodayCourseDay = Carbon::create(2020, 1, 2, 12);
        Carbon::setTestNow($FakeTodayCourseDay);

        $day = Day::checkIn($student);

        $this->assertFalse($day->checkIfCheckedOut());

        $day->checkOut();

        $this->assertTrue($day->checkIfCheckedOut());

    }

    public function test_checks_if_checked_in_same_day()
    {
        $user = factory(User::class)->create();

        $assignedDay = factory(Day::class)->create();//creates a day instance of today
        $user->addDayToUser($assignedDay); //assigns the day to user

        $dayToCompare = factory(Day::class)->create(); //another day instance of today, not assigned

        $check1 = $dayToCompare->checkIfCheckedInSameDay($user);
        $this->assertTrue($check1);
    }

    public function test_calcs_time_worked_in_a_day()
    {
        $checkIn = Carbon::createFromTime(8, 0, 0, 'Europe/Madrid');
        $checkOut = Carbon::createFromTime(16, 30, 0, 'Europe/Madrid');

        $day = factory(Day::class)->create(['checkIn'=> $checkIn, 'checkOut'=> $checkOut]);
        $workedtimeinDay = $day->getTimeWorkedInADay();

        $this->assertEquals($workedtimeinDay['hours'], "8");
        $this->assertEquals($workedtimeinDay['minutes'], "30");
    }

    public function test_calcs_time_worked_in_a_course()
    {
        $start = Carbon::createFromTime(DayTest::hour, DayTest::minute, DayTest::second, DayTest::tz);
        $time = Carbon::createFromTime(DayTest::endhour, DayTest::endminute, DayTest::endsecond, DayTest::tz);
        $days = [];
        $day1 = factory(Day::class)->create(['date'=>"2020-01-01", 'checkIn' => $start, 'checkOut' => $time]);
        $day2 = factory(Day::class)->create(['date'=>"2020-01-02", 'checkIn' => $start, 'checkOut' => $time]);
        $day3 = factory(Day::class)->create(['date'=>"2020-01-03", 'checkIn' => $start, 'checkOut' => $time]);
        array_push($days, $day1, $day2, $day3);
        $totalWorkedTimeInCourse = Day::getWorkedHoursOfAStudentInACourse($days);

        $this->assertEquals(24, $totalWorkedTimeInCourse['Hours']);
        $this->assertEquals(30, $totalWorkedTimeInCourse['Minutes']);
    }

    public function test_checks_if_today_corresponds_course_dates()
    {
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
