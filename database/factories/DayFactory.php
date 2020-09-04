<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Day;
use Carbon\Carbon;

use Faker\Generator as Faker;

$factory->define(Day::class, function (Faker $faker) {
    return [
        'date' => Carbon::now()->setTimezone('Europe/Madrid')->toDateString()
    ];
});

//'date'    => Carbon::now()->setTimezone('Europe/Madrid')->toDateString(),
