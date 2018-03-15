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
			'email' => 'root@gmail.com',
            'password' => bcrypt('loremroot'),
		]);

		$user->generateToken();

        factory(App\User::class)->create([
            'email' => 'test@test.com',
            'password' => bcrypt('loremtest'),
        ])->generateToken();
    }
}
