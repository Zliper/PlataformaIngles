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

		factory(Grupo::class)->times(10)->create();

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
			'id','grado','grupo' ,'periodo'
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
			'grado' => 1,
			'grupo' => 'E',
			'periodo' => '1986-07-27'
		];

		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		$this->json('POST','/api/grupos', $payload, $headers)
		->assertStatus(201)
		->assertJsonStructure([
			'id','grado','grupo' ,'periodo'
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
			'grado' => 3,
			'grupo' => 'Z',
			'periodo' => '1986-07-27'
		];

		$f = factory(Grupo::class)->create([
			'grado' => 2,
			'grupo' => 'A',
			'periodo' => '1986-06-27' 
		]);

		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		$this->json('PUT','/api/grupos/'. $f->id, $payload,  $headers)
		->assertStatus(200);

		$grupo = Grupo::find(1);

		$this->assertEquals(3, $grupo->grado);
		$this->assertEquals("Z", $grupo->grupo);
		$this->assertEquals("1986-07-27", $grupo->periodo);
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
