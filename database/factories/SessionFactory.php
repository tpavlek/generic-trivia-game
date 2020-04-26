<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Game;
use App\Session;
use Faker\Generator as Faker;

$factory->define(Session::class, function (Faker $faker) {

    return [
        'id' => $faker->firstName,
        'options' => new \App\SessionOptions(),
    ];
});
