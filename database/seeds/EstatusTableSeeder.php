<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;
use App\models\Estatus;

class EstatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estatus::create([
            'estatus' => 0
        ]);

        Estatus::create([
            'estatus' => 1
        ]);

        Estatus::create([
            'estatus' => 2
        ]);
    }
}
