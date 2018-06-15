<?php

$factory->define(App\Nominated::class, function (Faker\Generator $faker) {
    return [
        "company_id" => factory('App\Company')->create(),
        "cataward_id" => factory('App\Cataward')->create(),
        "year_id" => factory('App\Year')->create(),
        "materialdates" => $faker->date("Y-m-d", $max = 'now'),
        "docsdate" => $faker->date("Y-m-d", $max = 'now'),
        "matrialtype" => $faker->name,
        "materialloc" => $faker->name,
        "sitenumber" => $faker->randomNumber(2),
        "contactperson" => $faker->name,
        "cpemail" => $faker->safeEmail,
        "cpphone" => $faker->randomNumber(2),
        "presentation_name" => $faker->name,
        "presentation_site_no" => $faker->randomNumber(2),
        "member" => 0,
        "comments" => $faker->name,
        "eventpersonno" => $faker->randomNumber(2),
        "event_person" => $faker->name,
    ];
});
