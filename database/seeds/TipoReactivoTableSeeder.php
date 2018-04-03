<?php

use Illuminate\Database\Seeder;
use App\models\TipoReactivo;

class TipoReactivoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoReactivo::create([
            'tipo_reactivo' => 'Pregunta abierta'
        ]);
        
        TipoReactivo::create([
            'tipo_reactivo' => 'Pregunta true y false'
        ]);

        TipoReactivo::create([
            'tipo_reactivo' => 'Pregunta opcion multiple'
        ]);
    }
}
