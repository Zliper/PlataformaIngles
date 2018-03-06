<?php

use Illuminate\Database\Seeder;
use App\models\RolUsuario;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RolUsuario::create([
            'tipo_rol' => 'Maestro'
        ]);
        
        RolUsuario::create([
            'tipo_rol' => 'Coordinador'
        ]);
    }
}
