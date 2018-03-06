<?php

use Faker\Generator as Faker;

$factory->define(App\models\Materia::class, function (Faker $faker) {
    return [
        'materia' => 'Ingles' . ' ' . $faker->unique()->numberBetween(1,10),
    ];
});
