<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Justification;

class JustificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_justification_range(){

        $justification= Justification::create([
            'title' => 'Enfermedad',
            'description' => 'Estuve enfermo', 
            'start_date' => date("2020-01-02"),
            'end_date' => date("2020-01-09")
        ]);

        $justificationRange = $justification->getJustificationDates();

        $dayInBetween = date("2020-01-03");
        $dayOutOfRange = date("2020-01-10");
        $weekend = date("2020-01-04");

        $this->assertContains($dayInBetween, $justificationRange); 
        $this->assertNotContains($dayOutOfRange, $justificationRange);
        $this->assertNotContains($weekend, $justificationRange);

    }
}
