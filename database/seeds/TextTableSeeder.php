<?php

use Illuminate\Database\Seeder;

class TextTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\models\Text::class)->times(200)->create();
    }
}
