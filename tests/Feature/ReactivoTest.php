<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\models\Competencia;
use App\models\TipoReactivo;
use App\models\Estatus;
use App\models\Profesor;
use App\models\Reactivo;
use App\User;

class ReactivoTest extends TestCase
{

	/** @test */
	public function it_displays_reactivos() {

		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('competencias')->truncate();
		DB::table('tipo_reactivos')->truncate();
		DB::table('estatus')->truncate();
		DB::table('profesores')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		factory(Competencia::class)->times(2)->create();
		factory(TipoReactivo::class)->times(2)->create();
		factory(Estatus::class)->times(2)->create();
		factory(Profesor::class)->times(2)->create();

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('GET','/api/reactivos', [], $headers)
		->assertStatus(200)
		->assertJson([
			'data' => [],
		]);
	}

	/** @test */
	public function it_displays_a_sigle_reactivo() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('competencias')->truncate();
		DB::table('tipo_reactivos')->truncate();
		DB::table('estatus')->truncate();
		DB::table('profesores')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		factory(Competencia::class)->times(20)->create();
		factory(TipoReactivo::class)->times(20)->create();
		factory(Estatus::class)->times(20)->create();
		factory(Profesor::class)->times(20)->create();
		$f = factory(Reactivo::class)->create();

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('GET','/api/reactivos/' . $f->id, [] , $headers)
		->assertStatus(200)
		->assertJsonStructure([
			'data' => [
				'id',
				'attributes' => [
					'pregunta',
					'respuesta',
					'texto',
				],

				'relationships' => [
					['competencia',],
					['tipo',],
					['estatus'],
					['name','apellido'],
				]
			],
		]);
	}

	/** @test */
	public function reactivo_doesnt_exist() {

		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('competencias')->truncate();
		DB::table('tipo_reactivos')->truncate();
		DB::table('estatus')->truncate();
		DB::table('profesores')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('GET','/api/reactivos/0', [], $headers)
		->assertStatus(404)
		->assertJson([
			'error' => 'Resource not found',
		]);
	}

	/** @test */
	public function it_adds_a_new_reactivo() {

		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('competencias')->truncate();
		DB::table('tipo_reactivos')->truncate();
		DB::table('estatus')->truncate();
		DB::table('profesores')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];


		factory(Competencia::class)->times(2)->create();
		factory(TipoReactivo::class)->times(2)->create();
		factory(Estatus::class)->times(2)->create();
		factory(Profesor::class)->times(2)->create();

		$payload = [
			'competencia_id' => 1,
			'tipo_id' => 1,
			'estatus_id' => 1,
			'profesor_id' => 1,
			'pregunta' => 'lorem',
			'respuesta_correcta' => 'lorem',
			'texto' => "lorem",

		];

		$this->json('POST','/api/reactivos', $payload, $headers)
		->assertStatus(201)
		->assertJsonStructure([
			'data' => [
				'id',
				'attributes' => [
					'pregunta',
					'respuesta',
					'texto',
				],

				'relationships' => [
					['competencia',],
					['tipo',],
					['estatus'],
					['name','apellido'],
				]
			],	
		]);;
	}

	/** @test */
	public function it_adds_a_new_reactivo_fail() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('competencias')->truncate();
		DB::table('tipo_reactivos')->truncate();
		DB::table('estatus')->truncate();
		DB::table('profesores')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$payload = [
			'competencia_id' => 1,
			'tipo_id' => 1,
			'estatus_id' => 1,
			'profesor_id' => 1,
			'pregunta' => 'lorem',
			'respuesta_correcta' => 'lorem',
			'texto' => "lorem",

		];

		$this->json('POST','/api/reactivos', $payload, $headers)
		->assertStatus(400);
	}


	/** @test */
	public function it_updates_a_reactivo() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('competencias')->truncate();
		DB::table('tipo_reactivos')->truncate();
		DB::table('estatus')->truncate();
		DB::table('profesores')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		factory(Competencia::class)->times(10)->create();
		factory(Competencia::class)->times(2)->create();
		factory(TipoReactivo::class)->times(2)->times(2)->create();
		factory(Estatus::class)->times(2)->create();
		factory(Profesor::class)->times(2)->create();

		$i = factory(Reactivo::class)->create([
			'competencia_id' => 1,
			'tipo_id' => 1,
			'estatus_id' => 1,
			'profesor_id' => 1,
			'pregunta' => 'lorem',
			'respuesta_correcta' => 'lorem',
			'texto' => 'lorem',
		]);

		$payload = [
			'competencia_id' => 2,
			'tipo_id' => 1,
			'estatus_id' => 2,
			'profesor_id' => 1,
			'pregunta' => 'pregunta',
			'respuesta' => 'lorem',
			'texto' => 'xd',
		];

		$this->json('PUT','/api/reactivos/'.$i->id , $payload, $headers)
		->assertStatus(200)
		->assertJsonStructure([
			'data' => [
				'id',
				'attributes' => [
					'pregunta',
					'respuesta',
					'texto',
				],

				'relationships' => [
					['competencia'],
					['tipo'],
					['estatus'],
					['name','apellido']
				],
			]
		]);

		$i = Reactivo::find($i->id);

		$this->assertEquals(2, $i->competencia_id);
	}


	/** @test */
	public function it_deletes_a_reactivo() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('competencias')->truncate();
		DB::table('tipo_reactivos')->truncate();
		DB::table('estatus')->truncate();
		DB::table('profesores')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		factory(Competencia::class)->times(2)->create();
		factory(TipoReactivo::class)->times(2)->create();
		factory(Estatus::class)->times(2)->create();
		factory(Profesor::class)->times(2)->create();
		$f = factory(Reactivo::class)->create();

		$this->json('DELETE','/api/reactivos/' . $f->id, [], $headers)
		->assertStatus(204);
	}

	/** @test */
	public function it_deletes_a_reactivo_fail() {

		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('competencias')->truncate();
		DB::table('tipo_reactivos')->truncate();
		DB::table('estatus')->truncate();
		DB::table('profesores')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('DELETE','/api/reactivos/13242342', [], $headers)
		->assertStatus(404)
		->assertJson([
			'error' => 'Resource not found',
		]);;
	}


	/** @test */
	public function it_updates_a_reactivo_fail() {

		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('competencias')->truncate();
		DB::table('tipo_reactivos')->truncate();
		DB::table('estatus')->truncate();
		DB::table('profesores')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		factory(Competencia::class)->times(2)->create();
		factory(TipoReactivo::class)->times(2)->create();
		factory(Estatus::class)->times(2)->create();
		factory(Profesor::class)->create();

		$f = factory(Reactivo::class)->create();
		
		$payload = [
			'competencia_id' => 23,
			'tipo_id' => 12,
			'estatus_id' => 11,
			'profesor_id' => 1,
			'pregunta' => 'pregunta',
			'respuesta' => 'lorem',
			'texto' => 'xd',
		];

		$this->json('PUT','/api/reactivos/'.$f->id, $payload, $headers)
		->assertStatus(400)
		->assertJson([
			'error' => 'Query error',
		]);
	}
}
