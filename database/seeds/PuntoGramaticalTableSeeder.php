<?php

use Illuminate\Database\Seeder;

class PuntoGramaticalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\models\PuntoGramatical::class)->times(16)->create();
    }
}
