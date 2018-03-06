<?php

use Faker\Generator as Faker;

$factory->define(App\models\Alumno::class, function (Faker $faker) {
    return [
        'nombre' => $faker->firstName,
        'apellido' => $faker->lastName,
    ];
});
