<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Game;
use App\Session;
use Faker\Generator as Faker;

$factory->define(Game::class, function (Faker $faker) {
    return [
        'id' => $faker->randomNumber(),
        'state' => Game::STATE_SHOWING_BOARD,
        'date' => $faker->date(),
    ];
});
