<?php

use Faker\Generator as Faker;

$factory->define(App\models\Estatus::class, function (Faker $faker) {
    return [
        'estatus' => 'Aprobado',
    ];
});
