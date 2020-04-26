<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Clue::class, function (Faker $faker) {
    return [
        'value' => $faker->randomNumber(),
        'text' => $faker->sentence,
        'answer' => $faker->word,
        'is_daily_double' => false,
    ];
});
