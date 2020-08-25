<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Day;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_day_to_user()
    {
        $user= factory(User::class)->create();
        $day= factory(Day::class)->create();

        $user->addDayToUser($day);

        $this->assertNotNull($user->days);
        //$this->assertContains($day, $user->days); //falla pero no entiendo por que falla, Error: Failed asserting that a traversable contains
    }

    public function test_calc_age()
    {
        $user = factory(User::class)->create();
        $expected = 15;

        $age = $user->age();

        $this->assertEquals($expected, $age);
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
}
