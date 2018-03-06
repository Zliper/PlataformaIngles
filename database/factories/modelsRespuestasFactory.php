<?php

use Faker\Generator as Faker;
use App\models\Evaluacion;
use App\models\Reactivo;

$factory->define(App\models\Respuesta::class, function (Faker $faker) {

    $evaluacion = Evaluacion::count();
    $reactivo = Reactivo::count();

    return [
        'evaluacion_id' => $faker->numberBetween(2,$evaluacion),
        'reactivo_id' => $faker->numberBetween(1,$reactivo),
    ];
});
