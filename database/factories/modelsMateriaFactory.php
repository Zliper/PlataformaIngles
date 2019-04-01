<?php

use Faker\Generator as Faker;

$factory->define(App\models\Materia::class, function (Faker $faker) {
    return [
        'materia' => 'Ingles' . ' ' . $faker->unique()->numberBetween(1,10),
        'periodo' => $faker->monthName . '-' . $faker->monthName,
        // 'year' => $faker->year($max = 'now')
        'year' => '2019'
    ];
});
