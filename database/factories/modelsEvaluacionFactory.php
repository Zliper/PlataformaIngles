<?php

use Faker\Generator as Faker;
use App\models\CatalogoCuestionario;
use App\models\Alumno;
use App\models\Materia;


$factory->define(App\models\Evaluacion::class, function (Faker $faker) {

    $catalogo = CatalogoCuestionario::count();
    $alumno = Alumno::count();
    $materia = Materia::count();

    return [
        'cantidad_reactivos' => $faker->numberBetween(10,40),
        'nota' => $faker->sentence(12),
        'instruccion' => $faker->sentence(30),
        'status' => $faker->numberBetween(1,2),
        'materia_id' => $faker->numberBetween(1,$materia),
        'catalogo_id' => $faker->numberBetween(1,$catalogo),
        'alumno_id' => $faker->numberBetween(1,$alumno),
    ];
});
