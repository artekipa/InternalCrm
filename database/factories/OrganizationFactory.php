<?php

$factory->define(App\Organization::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "desc" => $faker->name,
    ];
});
