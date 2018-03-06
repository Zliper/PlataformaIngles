<?php

use Faker\Generator as Faker;
use App\models\Competencia;
use App\models\TipoReactivo;
use App\models\Estatus;
use App\models\Profesor;


$factory->define(App\models\Reactivo::class, function (Faker $faker) {
    $competencia = Competencia::count();
    $tipo = TipoReactivo::count();
    $estatus = Estatus::count();
    $profesor = Profesor::count();

    return [
        'pregunta' => $faker->sentence(7),
        'respuesta_correcta' => $faker->word,
        'texto' => $faker->sentence(15),
        'competencia_id' => $faker->numberBetween(1,$competencia),
        'tipo_id' => $faker->numberBetween(1,$tipo),
        'estatus_id' => $faker->numberBetween(1,$estatus),
        'profesor_id' => $faker->numberBetween(1,$profesor),
    ];
});
