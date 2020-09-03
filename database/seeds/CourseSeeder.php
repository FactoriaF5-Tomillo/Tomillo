<?php

use App\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run()
    {
        factory(Course::class)->create([
            'title' => "FactoriaF5",
            'description' => "Fullstack web dev course",
            'start_date' => "2020-09-01",
            'end_date' => "2020-09-10",
        ]);
        factory(Course::class, 10)->create();
    }
}
