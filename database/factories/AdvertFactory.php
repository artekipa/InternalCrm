<?php

$factory->define(App\Advert::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "desc" => $faker->name,
    ];
});
