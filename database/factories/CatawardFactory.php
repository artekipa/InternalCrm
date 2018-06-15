<?php

$factory->define(App\Cataward::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
    ];
});
