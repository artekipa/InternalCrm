<?php

$factory->define(App\Program::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
    ];
});
