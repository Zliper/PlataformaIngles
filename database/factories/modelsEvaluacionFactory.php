<?php

use Faker\Generator as Faker;
use App\models\CatalogoCuestionario;
use App\models\Profesor;
use App\models\Alumno;
use App\models\Materia;
use App\models\PuntoGramatical;


$factory->define(App\models\Evaluacion::class, function (Faker $faker) {

    $catalogo = CatalogoCuestionario::count();
    $alumno = Alumno::count();
    $profesor = Profesor::count();
    $materia = Materia::count();
    $punto_gramatical = PuntoGramatical::count();

    return [
        'cantidad_reading' => $faker->numberBetween(10,40),
        'cantidad_listening' => $faker->numberBetween(10,40),
        'cantidad_writing' => $faker->numberBetween(10,40),
        'nota' => $faker->sentence(12),
        'instruccion' => $faker->sentence(30),
        'status' => $faker->numberBetween(1,2),
        'materia_id' => $faker->numberBetween(1,$materia),
        'catalogo_id' => $faker->numberBetween(1,$catalogo),
        'punto_gramatical' => $faker->numberBetween(1,$punto_gramatical),
        'alumno_id' => $faker->numberBetween(1,$alumno),
        'profesor_id' => $faker->numberBetween(1,$profesor),
    ];
});
