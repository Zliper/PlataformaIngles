<?php

use Faker\Generator as Faker;
use App\models\Reactivo;

$factory->define(App\models\Comentario::class, function (Faker $faker) {
    $reactivo = Reactivo::count();

    return [
        'comentario' => $faker->sentence(10),
        'reactivo_id' => $faker->numberBetween(1,$reactivo-10),
    ];
});
