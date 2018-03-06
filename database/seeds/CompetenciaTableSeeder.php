<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;
use App\models\Competencia;

class CompetenciaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Competencia::create([
            'tipo_competencia' => 'Reading'
        ]);

        Competencia::create([
            'tipo_competencia' => 'Listening'
        ]);

        Competencia::create([
            'tipo_competencia' => 'Writing'
        ]);
    }
}
