<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'title'=>$faker->title, 'description'=>$faker->text, 'start_date'=>$faker->date, 'end_date'=>$faker->date
    ];
});
