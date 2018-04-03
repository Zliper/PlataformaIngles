<?php

use Faker\Generator as Faker;

$factory->define(App\models\Text::class, function (Faker $faker) {
    return [
        "text" => $faker->sentence(4)
    ];
});
