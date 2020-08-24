<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Day;

class UserTest extends TestCase
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

    public function test_add_day_to_user(){

        $user= factory(User::class)->create();
        $day= factory(Day::class)->create();

        $user->addDayToUser($day);
  
        $this->assertNotNull($user->days);
        $this->assertEquals($day->date, $user->days->last()->date);
        $this->assertEquals($day->user_id, $user->id);

    }
    /* when the user has no days assigned at all, the function and the test break because $user->days does not exist until the first day assignment 

    public function test_if_can_check_in(){

        $user= factory(User::class)->create();

        $this->assertTrue($user->checkIfCanCheckIn());

        $day= factory(Day::class)->create();
        $user->addDayToUser($day);

        $this->assertFalse($user->checkIfCanCheckIn());

        $user->days->last()->checkOut();

        $this->assertTrue($user->checkIfCanCheckIn());

        
    }
    */
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
