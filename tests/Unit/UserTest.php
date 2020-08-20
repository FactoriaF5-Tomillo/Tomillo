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
        $this->assertContains($day, $user->days); //falla pero no entiendo por que falla

    }
}
