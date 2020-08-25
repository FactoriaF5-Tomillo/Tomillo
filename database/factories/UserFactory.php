<?php

use App\User;

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->state(User::class, 'Teacher', [
    'type' => 'Teacher'
]);

$factory->state(User::class, 'Student', [
    'type' => 'Student'
]);

$factory->state(User::class, 'Admin', [
    'type' => 'Admin'
]);


$factory->define(User::class, function (Faker $faker) {
    $type= $faker->randomElement(['Admin', 'Teacher', 'Student']);
    $gender = $faker->randomElement(['Hombre', 'Mujer', "Otro"]);

    return [
        'name' => $faker->name,
        'surname' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'type' => $type,
        'gender' => $gender,
        'nationality' => $faker->country,
        'date_of_birth' => '2005-1-1',
        'email_verified_at' => now(),
        'password' => Hash::make('password'), // password
        'remember_token' => Str::random(10),
    ];
});
