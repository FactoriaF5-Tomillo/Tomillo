<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
//use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Day;

class DayTest extends TestCase
{
    
    //use RefreshDatabase;
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

    public function test_check_in()
    {
        $date= Day::setDate();
        
        $day= Day::checkIn($date, $date, $date);

        $this->assertEquals($day->date, $date);

    }
}
