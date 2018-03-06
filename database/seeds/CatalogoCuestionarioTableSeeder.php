<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;
use App\models\CatalogoCuestionario;


class CatalogoCuestionarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CatalogoCuestionario::create([
            'tipo_cuestionario' => 'Extraordinario'
        ]);

        CatalogoCuestionario::create([
            'tipo_cuestionario' => 'Recuperacion'
        ]);

        CatalogoCuestionario::create([
            'tipo_cuestionario' => 'Ordinario'
        ]);

        CatalogoCuestionario::create([
            'tipo_cuestionario' => 'Actividad'
        ]);
    }
}
