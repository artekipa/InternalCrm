<?php

$factory->define(App\Company::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "persontitle" => $faker->name,
        "personname" => $faker->name,
        "zipcode" => $faker->name,
        "city" => $faker->name,
        "phone" => $faker->randomNumber(2),
        "email" => $faker->safeEmail,
        "website" => $faker->name,
        "comments" => $faker->name,
        "nomination" => $faker->name,
        "senddate" => $faker->date("Y-m-d", $max = 'now'),
        "user_id" => factory('App\User')->create(),
    ];
});
