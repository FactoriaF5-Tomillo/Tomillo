<?php

namespace Tests\Unit;


use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Day;
use App\User;

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

    public function test_check_if_checked_in_same_day(){

        $user = factory(User::class)->create();

        $checkedInDay = Day::checkIn($user);//creates a day instance of today and checks in

        $dayToCompare = factory(Day::class)->create(); //another day instance of today, not checked-in

        //when we try to reach the days field of user before assigning any day by check-in, the user object anull itself

        $check1 = $dayToCompare->checkIfCheckedInSameDay($user);

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

        $HoursPassedSinceStart   = $HourRightNow - 8;
        $MinutesPassedSinceStart = ($HoursPassedSinceStart * 60) + $MinutesRightNow;

        $this->assertEquals($HoursPassedSinceStart, $workedtimeinDay[0]);
        $this->assertEquals($MinutesPassedSinceStart, $workedtimeinDay[1]);
    }
}
