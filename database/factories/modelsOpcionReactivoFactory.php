<?php

use Faker\Generator as Faker;
use App\models\Reactivo;


$factory->define(App\models\OpcionReactivo::class, function (Faker $faker) {

    $reactivo = Reactivo::count();

    return [
        'opcion' => 'Opcion' . ' ' . $faker->word,
        'reactivo_id' => $faker->numberBetween(1,$reactivo-10),
    ];
});
