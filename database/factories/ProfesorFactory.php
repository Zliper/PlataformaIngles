<?php

use Faker\Generator as Faker;

$factory->define(App\models\Profesor::class, function (Faker $faker) {
    return [
        'nombre' => $faker->firstName,
        'apellido' => $faker->lastName,
    ];
});
