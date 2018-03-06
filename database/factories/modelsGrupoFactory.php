<?php

use Faker\Generator as Faker;

$factory->define(App\models\Grupo::class, function (Faker $faker) {
    return [
        'grado' => $faker->numberBetween(1,10),
        'grupo' => $faker->randomElement($array = range('A','Z')),
        'periodo' => $faker->date($format = 'Y-m-d', $max = 'now'),
    ];
});
