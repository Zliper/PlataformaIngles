<?php

use Illuminate\Database\Seeder;

use App\models\Grupo;
use App\models\Alumno;

class GrupoHasAlumnoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grupo = Grupo::count();
        $alumno = Alumno::count();

        for($i=1; $i<=200; $i++) {
            DB::table('grupo_has_alumno')->insert([
                'grupo_id' => rand(1,$grupo),
                'alumno_id' => rand(1,$alumno)
            ]);
        }
    }
}
