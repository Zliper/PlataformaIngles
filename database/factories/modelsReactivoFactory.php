<?php

use Faker\Generator as Faker;
use App\models\Competencia;
use App\models\TipoReactivo;
use App\models\Estatus;
use App\models\Profesor;
use App\models\CatalogoCuestionario;
use App\models\PuntoGramatical;
use App\models\Text;

$factory->define(App\models\Reactivo::class, function (Faker $faker) {
    $competencia = Competencia::count();
    $tipo = TipoReactivo::count();
    $estatus = Estatus::count();
    $profesor = Profesor::count();
    $catalogo = CatalogoCuestionario::count();
    $punto = PuntoGramatical::count();
    $text = Text::count();

    return [
        'pregunta' => $faker->sentence(7),
        'respuesta_correcta' => $faker->word,
        'competencia_id' => $faker->numberBetween(1,$competencia),
        'tipo_id' => $faker->numberBetween(1,$tipo),
        'estatus_id' => $faker->numberBetween(1,$estatus),
        'profesor_id' => $faker->numberBetween(1,$profesor),
        'text_id' => $faker->numberBetween(1,$text),
        'punto_id' => $faker->numberBetween(1,$punto),
        'catalogo_id' => $faker->numberBetween(1,$catalogo)
    ];
});
