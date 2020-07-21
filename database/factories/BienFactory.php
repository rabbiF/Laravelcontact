<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Model\Bien::class, function (Faker $faker) {
    return [
        "user_id" => function() {
            return User::all()->random();
        },  
        "name" => $faker->word
    ];
});
