<?php

$factory->define(App\Task::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "description" => $faker->name,
        "status_id" => factory('App\TaskStatus')->create(),
        "due_date" => $faker->date("Y-m-d", $max = 'now'),
        "user_id" => factory('App\User')->create(),
        "created_by_id" => factory('App\User')->create(),
        "created_by_team_id" => factory('App\Team')->create(),
    ];
});
