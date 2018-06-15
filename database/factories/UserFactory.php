<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "firstname" => $faker->name,
        "lastname" => $faker->name,
        "phone" => $faker->name,
        "email" => $faker->safeEmail,
        "password" => str_random(10),
        "created_by_id" => factory('App\User')->create(),
        "codenumber" => $faker->randomNumber(2),
        "remember_token" => $faker->name,
        "approved" => 0,
        "team_id" => factory('App\Team')->create(),
    ];
});
