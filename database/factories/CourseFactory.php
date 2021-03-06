<?php
use App\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'title' => $faker->bs,
        'description' => $faker->text,
        'start_date' => $faker->date,
        'end_date' => $faker->date,
    ];
});
