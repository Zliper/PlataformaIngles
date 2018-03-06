<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;
use App\models\Carrera;

class CarreraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Carrera::create([
            'nombre_carrera' => 'IDS'
        ]);

        Carrera::create([
            'nombre_carrera' => 'Petrolera'
        ]);

        Carrera::create([
            'nombre_carrera' => 'Mecatronica'
        ]);

        Carrera::create([
            'nombre_carrera' => 'Biomedica'
        ]);

        Carrera::create([
            'nombre_carrera' => 'Energia'
        ]);
    }
}
