<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Day;
use App\User;

class DayTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
    public function test_set_date()
    {
        $date= Day::setDate();
        $this->assertNotNull($date);

    }

    public function test_set_time()
    {
        $time= Day::setTime();
        $this->assertNotNull($time);

    }


    public function test_check_in()
    {
        $user= factory(User::class)->create();

        $day= Day::checkIn($user);

        $user->addDayToUser($day);

        $this->assertNotNull($day);
        $this->assertNotNull($day->date);
        $this->assertNotNull($day->checkIn);
        $this->assertEquals($user->id, $day->user_id);

    }
    public function test_check_out()
    {
        $user= factory(User::class)->create();
        $day= Day::checkIn($user);

        $day->checkout();

        $this->assertNotNull($day->checkOut);

    }

    public function test_check_if_user_checked_out(){

        $user= factory(User::class)->create();
        $day= Day::checkIn($user);

        $this->assertFalse($day->checkIfCheckedOut());

        $day->checkOut();

        $this->assertTrue($day->checkIfCheckedOut());

    }

    public function test_check_if_checked_in_same_day(){

        $user= factory(User::class)->create();
        $day= factory(Day::class)->create();
        $sameDay= factory(Day::class)->create();

        $check1= $day->checkIfCheckedInSameDay($user);
        $check2= $sameDay->checkIfCheckedInSameDay($user);
  
        $this->assertFalse($check1);
        $this->assertTrue($check2);
        
    }


}
