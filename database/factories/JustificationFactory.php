<?php


use App\Justification;
use Faker\Generator as Faker;

$factory->define(Justification::class, function (Faker $faker) {
    return [
        'file' => $faker->name,
        'title' => $faker->title,
        'description' => $faker->text,
        'approval'=> $faker->boolean,
        'start_date'=> $faker->date,
        'end_date'=> $faker->date,
    ];
});
