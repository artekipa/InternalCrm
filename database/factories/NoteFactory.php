<?php

$factory->define(App\Note::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "desc" => $faker->name,
        "created_by_id" => factory('App\User')->create(),
        "created_by_team_id" => factory('App\Team')->create(),
    ];
});
