<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CourseSeeder::class);
        //$this->call(CourseUserSeeder::class);
        //$this->call(DaySeeder::class);
        //$this->call(JustificationSeeder::class);
    }
}
