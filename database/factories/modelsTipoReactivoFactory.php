<?php

use Faker\Generator as Faker;

$factory->define(App\models\TipoReactivo::class, function (Faker $faker) {
    return [
        'tipo_reactivo' => $faker->word,
    ];
});
