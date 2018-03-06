<?php

use Illuminate\Database\Seeder;

class GrupoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\models\Grupo::class)->times(20)->create();
    }
}
