<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\PlayerData::class, function (Faker $faker) {
    return [
        'name'=> $faker->text(10),
        'userScore'=> $faker->randomDigit,
        'compScore'=> $faker->randomDigit,
        'userWon'=> $faker->numberBetween($min = 0, $max = 1)
    ];
});
