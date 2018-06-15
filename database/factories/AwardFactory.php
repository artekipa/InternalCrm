<?php

$factory->define(App\Award::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "created_by_id" => factory('App\User')->create(),
        "created_by_team_id" => factory('App\Team')->create(),
    ];
});
