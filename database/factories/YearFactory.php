<?php

$factory->define(App\Year::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->randomNumber(2),
    ];
});
