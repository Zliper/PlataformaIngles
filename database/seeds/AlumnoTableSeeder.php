<?php

use Illuminate\Database\Seeder;

class AlumnoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\models\Alumno::class)->times(120)->create();

        $user = factory(App\User::class)->create([
			'email' => 'root_test@gmail.com',
		]);

		$user->generateToken();
    }
}
