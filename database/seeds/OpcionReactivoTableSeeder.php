<?php

use Illuminate\Database\Seeder;

class OpcionReactivoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\models\OpcionReactivo::class)->times(400)->create();
    }
}
