<?php

namespace Tests\Feature;

use App\User;
use App\models\Materia;
use App\models\PuntoGramatical;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PuntoGramaticalTest extends TestCase
{
	/** @test */
	public function it_displays_puntos_gramaticales()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('puntos_gramaticales')->truncate();
		DB::table('users')->truncate();
		DB::table('materias')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		factory(Materia::class)->times(10)->create();	
		factory(PuntoGramatical::class)->times(10)->create();

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('GET','/api/puntos', [], $headers)
		->assertStatus(200)
		->assertJsonStructure([
			'data' => [
				"puntos_gramaticales" => []
			]	
		]);
	}

	/** @test */
	public function it_displays_a_single_punto()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('puntos_gramaticales')->truncate();
		DB::table('users')->truncate();
		DB::table('materias')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		factory(Materia::class)->times(10)->create();	
		$p = factory(PuntoGramatical::class)->create();

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('GET','/api/puntos/'. $p->id , [], $headers)
		->assertStatus(200)
		->assertJsonStructure([
			'id', 'unidad','punto_gramatical'	
		]);
	}

	/** @test */
	public function punto_doesnt_exist()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('puntos_gramaticales')->truncate();
		DB::table('users')->truncate();
		DB::table('materias')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('GET','/api/puntos/1', [], $headers)
		->assertStatus(404)
		->assertJsonStructure([
			'error'
		]);
	}

	/** @test */
	public function it_adds_a_new_punto()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('puntos_gramaticales')->truncate();
		DB::table('users')->truncate();
		DB::table('materias')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$materia = factory(Materia::class)->create();

		$payload = [
			'unidad' => 1,
			'punto_gramatica' => 'lorem',
			'materia_id' => $materia->id 
		];

		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		$this->json('POST','/api/puntos', $payload, $headers)
		->assertStatus(201)
		->assertJsonStructure([			
			'id', 'unidad' ,'punto_gramatical'
		]);

		$punto = PuntoGramatical::find(1);

		$this->assertEquals(1, PuntoGramatical::count());
		$this->assertEquals(1, $punto->id);
		$this->assertEquals("lorem", $punto->punto_gramatica);
	}

	/** @test */
	public function it_adds_a_new_punto_fail()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('puntos_gramaticales')->truncate();
		DB::table('users')->truncate();
		DB::table('materias')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$payload = [
			'unidad' => 1,
			'punto_gramatica' => 'lorem',
		];

		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		$this->json('POST','/api/puntos', $payload, $headers)
		->assertStatus(400)
		->assertJsonStructure([
			'error'
		]);
	}

	/** @test */
	public function it_updates_a_punto()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('puntos_gramaticales')->truncate();
		DB::table('users')->truncate();
		DB::table('materias')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		factory(Materia::class)->times(10)->create();

		$f = factory(PuntoGramatical::class)->create();

		$payload = [
			'unidad' => 2,
			'punto_gramatica' => "nuevo",
			'materia_id' => $f->materia_id
		];

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		$this->json('PUT','/api/puntos/' . $f->id , $payload, $headers)
		->assertStatus(200)
		->assertJsonStructure([
			'id', 'unidad' ,'punto_gramatical'
		]);

		$punto = PuntoGramatical::find(1);

		$this->assertEquals(2, $punto->unidad);
		$this->assertEquals("nuevo", $punto->punto_gramatica);
	}

	/** @test */
	public function it_updates_a_punto_fail()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('puntos_gramaticales')->truncate();
		DB::table('users')->truncate();
		DB::table('materias')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');


		factory(Materia::class)->create();

		$f = factory(PuntoGramatical::class)->create();

		$payload = [
			'unidad' => 1,
			'punto_gramatica' => "nuevo",
			'materia_id' => 0
		];

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		$this->json('PUT','/api/puntos/' . $f->id , $payload, $headers)
		->assertStatus(400)
		->assertJsonStructure([
			'error'
		]);
	}

	/** @test */
	public function it_deletes_a_punto()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('puntos_gramaticales')->truncate();
		DB::table('users')->truncate();
		DB::table('materias')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');


		factory(Materia::class)->create();

		$f = factory(PuntoGramatical::class)->create();

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		$this->json('DELETE','/api/puntos/' . $f->id, [], $headers)
		->assertStatus(204);
	}

	/** @test */
	public function it_deletes_a_punto_fail()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('puntos_gramaticales')->truncate();
		DB::table('users')->truncate();
		DB::table('materias')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		$this->json('DELETE','/api/puntos/1', [], $headers)
		->assertStatus(404);
	}
}
