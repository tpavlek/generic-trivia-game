<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'is_complete' => true,
        'double_jeopardy' => false,
    ];
});

$factory->state(Category::class, 'double_jeopardy', [
    'double_jeopardy' => true,
]);
