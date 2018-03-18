<?php

use Faker\Generator as Faker;

$factory->define(App\models\Materia::class, function (Faker $faker) {
    return [
        'materia' => 'Ingles' . ' ' . $faker->unique()->numberBetween(1,10),
        'periodo' => $faker->date($format = 'Y-m-d', $max = 'now'),
    ];
});
