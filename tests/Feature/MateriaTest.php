<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\models\Materia;
use App\User;


class MateriaTest extends TestCase
{
	/** @test */
	public function it_displays_materias() {

		$user = factory(User::class)->create([
			'email' => 'root_test@gmail.com',
		]);

		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		factory(Materia::class)->times(2)->create();

		$this->json('GET','/api/materias', [], $headers)
		->assertStatus(200)
		->assertJsonStructure([
			'data' => [
				"materias" => []
			],
		]);
	}

	/** @test */
	public function it_displays_a_sigle_materia() {

		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('materias')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root_test@gmail.com',
		]);

		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		$m = factory(Materia::class)->create();

		$this->json('GET','/api/materias/'.$m->id, [], $headers)
		->assertStatus(200)
		->assertJsonStructure([
			"id",
			"materia",
			"periodo",
			"year"
		]);
	}

	/** @test */
	public function it_displays_resource_not_found() {

		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('materias')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root_test@gmail.com',
		]);

		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];
		$this->json('GET','/api/materias/1', [], $headers)
		->assertStatus(404);
	}


	/** @test */
	public function it_adds_a_new_materia() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('materias')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root_test@gmail.com',
		]);

		$payload = [
			"materia" => "ingles 8",
			'periodo' => '1986-07-27',
			"year" => 1233
		];

		$this->assertEquals(0, DB::table('materias')->count());

		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		$this->json('POST','/api/materias', $payload, $headers)
		->assertStatus(201)
		->assertJsonStructure([
			"id",
			"materia",
			"periodo",
			"year"
		]);

		$materia = Materia::find(1);
		$this->assertEquals(1, $materia->id);

	}

	/** @test */
	public function it_adds_a_new_materia_fail() {

		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('materias')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$payload = [];

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('POST','/api/carreras', $payload, $headers)
		->assertStatus(400);
	}

	/** @test */
	public function it_updates_a_new_materia() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('materias')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$m = factory('App\models\Materia')->create();

		$payload = [
			'materia' => 'ingles 9'
		];

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('PUT','/api/materias/'. $m->id, $payload, $headers)
		->assertStatus(200);

		$materia = Materia::find(1);

		$this->assertEquals('ingles 9',$materia->materia);
	}


	/** @test */
	public function it_updates_a_new_materia_fail() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('materias')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$payload = [
			'materia' => 'Meca'
		];

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('PUT','/api/materia/0', $payload, $headers)
		->assertStatus(404);
	}

	/** @test */
	public function it_deletes_a_materia() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('materias')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$m = factory('App\models\Materia')->create();

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('DELETE','/api/materias/' . $m->id, [],  $headers)
		->assertStatus(204);
	}

	/** @test */
	public function it_deletes_a_materia_fail() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('materias')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('DELETE','/api/materias/1', [],  $headers)
		->assertStatus(404);
	}
}
