<?php

use Illuminate\Database\Seeder;

use App\models\Grupo;
use App\models\Carrera;

class GrupoHasCarreraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grupo = Grupo::count();
        $carrera = Carrera::count();

        for($i=1; $i<=10; $i++) {
            DB::table('grupo_has_carrera')->insert([
                'grupo_id' => rand(1,$grupo),
                'carrera_id' => rand(1,$carrera)
            ]);
        }
    }
}
