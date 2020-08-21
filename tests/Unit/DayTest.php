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


}
