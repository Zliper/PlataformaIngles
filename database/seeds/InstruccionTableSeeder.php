<?php

use Illuminate\Database\Seeder;

class InstruccionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\models\Instruccion::class)->times(20)->create();
    }
}
