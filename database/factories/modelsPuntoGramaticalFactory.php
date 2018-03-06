<?php

use Faker\Generator as Faker;
use App\models\Materia;



$factory->define(App\models\PuntoGramatical::class, function (Faker $faker) {
    $materias = Materia::count();
    return [
        'unidad' => $faker->numberBetween(1,10),
        'punto_gramatica' => 'Tema' . ' ' . $faker->unique()->word,
        'materia_id' => $faker->numberBetween(1,$materias),
    ];
});
