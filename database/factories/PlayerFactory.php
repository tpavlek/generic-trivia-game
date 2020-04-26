<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Player;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Player::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
