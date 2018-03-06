<?php

use Illuminate\Database\Seeder;

class ReactivoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\models\Reactivo::class)->times(180)->create();
    }
}
