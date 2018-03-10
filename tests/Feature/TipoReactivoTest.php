<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\models\TipoReactivo;
use App\User;


class TipoReactivoTest extends TestCase
{

	/** @test */
	public function it_displays_tipos() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('tipo_reactivos')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
		
		factory(TipoReactivo::class)->times(2)->create();

		$user = factory(User::class)->create([
			'email' => 'root_test@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('GET','/api/tipos',[], $headers)
		->assertStatus(200);

	}

	/** @test */
	public function it_gets_404() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('tipo_reactivos')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
		$user = factory(User::class)->create([
			'email' => 'root_test@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('GET','/api/tipos/1',[], $headers)
		->assertStatus(404);
	}
}
