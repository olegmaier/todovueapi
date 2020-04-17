<?php

use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        //
        'title'=>$faker->text(50),
        'description'=>$faker->text(500),
        'user_id'=>$faker->randomDigit
    ];
});
