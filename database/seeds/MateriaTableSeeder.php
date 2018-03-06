<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

use App\models\Materia;

class MateriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\models\Materia::class)->times(10)->create();
        // Materia::create([
        //     'materia' => 'Ingles 1'
        // ]);
        
        // Materia::create([
        //     'materia' => 'Ingles 2'
        // ]);
        
        // Materia::create([
        //     'materia' => 'Ingles 3'
        // ]);

        // Materia::create([
        //     'materia' => 'Ingles 4'
        // ]);

        // Materia::create([
        //     'materia' => 'Ingles 5'
        // ]);
    }
}
