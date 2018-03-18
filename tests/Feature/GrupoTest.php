<?php

namespace Tests\Feature;

use App\User;
use App\models\Grupo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class GrupoTest extends TestCase
{
	/** @test */
	public function it_displays_grupos()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('grupos')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root_test@gmail.com',
		]);

		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		factory(Grupo::class)->times(2)->create();
		//factory(Grupo::class)->times(10)->create();

		$this->json('GET','/api/grupos', [], $headers)
		->assertStatus(200)
		->assertJsonStructure([
			'data' => [
				"grupos" => []
			],
		]);
	}    

	/** @test */
	public function it_displays_a_sigle_group()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('grupos')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root_test@gmail.com',
		]);

		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		$f = factory(Grupo::class)->create();

		$this->json('GET','/api/grupos/' . $f->id , [], $headers)
		->assertStatus(200)
		->assertJsonStructure([
			'id','grupo'
		]);
	}

	/** @test */
	public function it_displays_resource_not_found() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('grupos')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root_test@gmail.com',
		]);

		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		$this->json('GET','/api/grupos/1',[], $headers)
		->assertStatus(404);
	}

	/** @test */
	public function it_adds_a_new_grupo() { 
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('grupos')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root_test@gmail.com',
		]);

		$payload = [
			'grupo' => 'E',
		];

		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		$this->json('POST','/api/grupos', $payload, $headers)
		->assertStatus(201)
		->assertJsonStructure([
			'id','grupo'
		]);
	}


	/** @test */
	public function it_adds_a_new_grupo_fail(){
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('grupos')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root_test@gmail.com',
		]);

		$payload = [
		];

		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		$this->json('POST','/api/grupos', $payload, $headers)
		->assertStatus(400);
	}

	/** @test */
	public function it_updates_a_new_grupo(){
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('grupos')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root_test@gmail.com',
		]);

		$payload = [
			'grupo' => 'Z'
		];

		$f = factory(Grupo::class)->create([
			'grupo' => 'A'
		]);

		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		$this->json('PUT','/api/grupos/'. $f->id, $payload,  $headers)
		->assertStatus(200);

		$grupo = Grupo::find(1);

		$this->assertEquals("Z", $grupo->grupo);
	}

	/** @test */
	public function it_updates_a_new_grupo_fail(){
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('grupos')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root_test@gmail.com',
		]);

		$payload = [];

		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		$this->json('PUT','/api/grupos/0', $payload, $headers)
		->assertStatus(404);
	}

	/** @test */
	public function it_deletes_a_grupo() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('grupos')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root_test@gmail.com',
		]);

		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		$f = factory(Grupo::class)->create();

		$this->json('DELETE','/api/grupos/'. $f->id,[], $headers)
		->assertStatus(204);
	}

	/** @test */
	public function it_deletes_a_grupo_fail() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('grupos')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root_test@gmail.com',
		]);

		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		$this->json('DELETE','/api/grupos/1', [] , $headers)
		->assertStatus(404);
	}
}
