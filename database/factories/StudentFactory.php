<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    $gender = $faker->randomElement(['male', 'female']);
    $course = $faker->randomElement(['Peluqueria','Estética', 'Cocina', 'Informática', 'Carpintería']);
    return [
        'name'=>$faker->name, 'surname'=>$faker->lastName, 'nationality'=>$faker->country,
        'email'=>$faker->email, 'gender'=>$gender, 'currentcourse'=>$course
    ];
});
