<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\models\Carrera;
use App\models\Groupo;
use App\User;

class CarreraTest extends TestCase
{
	use RefreshDatabase;


	/** @test */
	public function it_displays_carreras() {

		Carrera::create([
			'nombre_carrera' => 'IDS'
		]);

		Carrera::create([
			'nombre_carrera' => 'Petrolera'
		]);

		Carrera::create([
			'nombre_carrera' => 'Mecatronica'
		]);

		Carrera::create([
			'nombre_carrera' => 'Biomedica'
		]);

		Carrera::create([
			'nombre_carrera' => 'Energia'
		]);

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);
		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('GET','/api/carreras', [], $headers)
		->assertStatus(200)
		->assertJson([
			'data' => [],
		]);

		$this->assertEquals(5, DB::table('carreras')->count());
	}

	/** @test */
	public function it_displays_a_single_carrera() {

		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('carreras')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		Carrera::create([
			'nombre_carrera' => 'IDS'
		]);

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);
		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('GET','/api/carreras/1', [], $headers)
		->assertStatus(200)
		->assertJson([
			'data' => [],
		]);
	}


	/** @test */
	public function reactivo_doesnt_exist() {

		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('carreras')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('GET','/api/carreras/0', [], $headers)
		->assertStatus(404)
		->assertJson([
			'error' => 'Resource not found',
		]);
	}


	/** @test */
	public function it_adds_a_new_carrera() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('carreras')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$payload = [
			"nombre_carrera" => "IDS"
		];

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('POST','/api/carreras', $payload, $headers)
		->assertStatus(201)
		->assertJsonStructure([
			'data' => [
				'id',
				'attributes' => [
					'carrera',
				],
				'relationships' => [
					['grupos' => []]
				]
			],	
		]);

		$this->assertEquals(1, DB::table('carreras')->count());
	}


	/** @test */
	public function it_adds_a_new_carrera_fail() {

		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('carreras')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$payload = [
			'email' => 'root@gmail.com',
		];

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('POST','/api/carreras', $payload, $headers)
		->assertStatus(400);

	}

	/** @test */
	public function it_updates_a_new_carrera() {

		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('carreras')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		Carrera::create([
			'nombre_carrera' => 'IDS'
		]);

		$payload = [
			'nombre_carrera' => 'Meca'
		];

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('PUT','/api/carreras/1', $payload, $headers)
		->assertStatus(200)
		->assertJsonStructure([
			'data' => [
				'id',
				'attributes' => [
					'carrera',
				],

				'relationships' => [
					['grupos' => []]
				]
			],	
		]);

		$carrera = Carrera::find(1);

		$this->assertEquals('Meca',$carrera->nombre_carrera);
	}

	/** @test */
	public function it_updates_a_new_carrera_fail() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('carreras')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$payload = [
			'nombre_carrera' => 'Meca'
		];

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('PUT','/api/carreras/0', $payload, $headers)
		->assertStatus(404);
	}

	/** @test */
	public function it_deletes_a_carrera() {

		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('carreras')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
		
		Carrera::create([
			'nombre_carrera' => 'IDS'
		]);

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('DELETE','/api/carreras/1', [],  $headers)
		->assertStatus(204);
	}
}
