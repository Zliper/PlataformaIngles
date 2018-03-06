<?php

use Illuminate\Database\Seeder;

class RespuestaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\models\Respuesta::class)->times(220)->create();
    }
}
