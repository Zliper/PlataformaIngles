<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\models\Evaluacion;
use App\models\Reactivo;

class EvaluacionHasReactivoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $evaluacion = Evaluacion::count();
        $Reactivo = Reactivo::count();

        for($i=1; $i<=1000; $i++) {
            DB::table('evaluacion_has_reactivo')->insert([
                'evaluacion_id' => rand(1,$evaluacion),
                'reactivo_id' => rand(1,$Reactivo)
            ]);
        }
    }
}
