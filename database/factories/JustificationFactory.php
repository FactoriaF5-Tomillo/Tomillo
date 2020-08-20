<?php


use App\Justification;
use Faker\Generator as Faker;

$factory->define(Justification::class, function (Faker $faker) {
    return [
        'file' => $faker->name,
        'description' => $faker->text,
        'approval'=> $faker->boolean,
    ];
});
