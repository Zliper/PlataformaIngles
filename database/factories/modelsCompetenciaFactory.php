<?php

use Faker\Generator as Faker;

$factory->define(App\models\Competencia::class, function (Faker $faker) {
    return [
        'tipo_competencia' => $faker->word,
    ];
});
