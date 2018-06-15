<?php

$factory->define(App\Catadvert::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
    ];
});
