<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Model\Client::class, function (Faker $faker) {
    return [
        "user_id" => function() {
            return User::all()->random();
        },  
        "date_contact" => $faker->date(),
        "name" => $faker->lastName,
        "firstname" => $faker->firstName,
        "email" => $faker->freeEmail,
        "phone" => $faker->phoneNumber,
        "contact_origine" => $faker->word,
        "projet" => $faker->word,
        "type_de_bien" => $faker->word,
        "etat" => $faker->word,
        "secteur" => $faker->streetName,
        "commentaires" => $faker->text,
        "contact" => $faker->word,
        "suivi" => $faker->word,
        "budget" => $faker->word,
        "client_nego" => $faker->word
    ];
});
