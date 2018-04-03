<?php

use Faker\Generator as Faker;
use App\models\TipoReactivo;

$factory->define(App\models\Instruccion::class, function (Faker $faker) {
    $tipo = TipoReactivo::count();
    return [
        "instruccion" => $faker->sentence(3),
        "tipo_reactivo_id" => $faker->numberBetween(1,$tipo),
    ];
});
