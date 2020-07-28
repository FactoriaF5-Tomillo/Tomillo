<?php

use App\Teacher;
use Faker\Generator as Faker;

$factory->define(Teacher::class, function (Faker $faker) {

    $gender = $faker->randomElement(['male', 'female']);
    return [
        'name' => $faker->name,
        'surname' => $faker->lastName,
        'email' => $faker->email,
        'gender' => $gender,
    ];

});
