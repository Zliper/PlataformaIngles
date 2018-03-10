<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \Illuminate\Support\Facades\DB;
use App\models\Estatus;
use App\User;


class EstatusTest extends TestCase
{
	/** @test */
	public function it_displays_estatus() {

		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('estatus')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		factory(Estatus::class)->times(2)->create();

		$user = factory(User::class)->create([
			'email' => 'root_test@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('GET','/api/estatus',[], $headers)
		->assertStatus(200);

	}

	/** @test */
	public function it_gets_404() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('estatus')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root_test@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('GET','/api/estatus/0',[], $headers)
		->assertStatus(404);
	}
}
