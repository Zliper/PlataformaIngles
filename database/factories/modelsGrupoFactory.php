<?php

use Faker\Generator as Faker;

$factory->define(App\models\Grupo::class, function (Faker $faker) {
    return [
        'grupo' => $faker->randomElement($array = range('A','Z')),  
    ];
});
