<?php

$factory->define(App\Trade::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
    ];
});
