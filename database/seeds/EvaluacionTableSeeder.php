<?php

use Illuminate\Database\Seeder;

class EvaluacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\models\Evaluacion::class)->times(70)->create();
    }
}
