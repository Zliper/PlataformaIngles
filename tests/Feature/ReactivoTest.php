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

	use RefreshDatabase;

	/** @test */
	public function it_displays_reactivos() {

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
		\Illuminate\Support\Facades\DB::table('competencias')->truncate();
		\Illuminate\Support\Facades\DB::table('tipo_reactivos')->truncate();
		\Illuminate\Support\Facades\DB::table('estatus')->truncate();
		\Illuminate\Support\Facades\DB::table('profesores')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		factory(Competencia::class)->times(20)->create();
		factory(TipoReactivo::class)->times(20)->create();
		factory(Estatus::class)->times(20)->create();
		factory(Profesor::class)->times(20)->create();

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		factory(Reactivo::class)->create([
			'competencia_id' => 1,
			'tipo_id' => 1,
			'estatus_id' => 1,
			'profesor_id' => 1,
		]);


		$this->json('GET','/api/reactivos/1', [] , $headers)
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
		\Illuminate\Support\Facades\DB::table('competencias')->truncate();
		\Illuminate\Support\Facades\DB::table('tipo_reactivos')->truncate();
		\Illuminate\Support\Facades\DB::table('estatus')->truncate();
		\Illuminate\Support\Facades\DB::table('profesores')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');


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

		$this->json('POST','/api/reactivos', $payload)
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
		\Illuminate\Support\Facades\DB::table('competencias')->truncate();
		\Illuminate\Support\Facades\DB::table('tipo_reactivos')->truncate();
		\Illuminate\Support\Facades\DB::table('estatus')->truncate();
		\Illuminate\Support\Facades\DB::table('profesores')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$payload = [
			'competencia_id' => 1,
			'tipo_id' => 1,
			'estatus_id' => 1,
			'profesor_id' => 1,
			'pregunta' => 'lorem',
			'respuesta_correcta' => 'lorem',
			'texto' => "lorem",

		];

		$this->json('POST','/api/reactivos', $payload)
		->assertStatus(400);
	}


	/** @test */
	public function it_updates_a_reactivo() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		\Illuminate\Support\Facades\DB::table('competencias')->truncate();
		\Illuminate\Support\Facades\DB::table('tipo_reactivos')->truncate();
		\Illuminate\Support\Facades\DB::table('estatus')->truncate();
		\Illuminate\Support\Facades\DB::table('profesores')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');


		factory(Competencia::class)->times(10)->create();

		factory(Competencia::class)->times(2)->create();

		factory(TipoReactivo::class)->times(2)->times(2)->create();
		factory(Estatus::class)->times(2)->create();
		factory(Profesor::class)->times(2)->create();

		factory(Reactivo::class)->create([
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

		$this->json('PUT','/api/reactivos/1', $payload)
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
	}


	/** @test */
	public function it_deletes_a_reactivo() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		\Illuminate\Support\Facades\DB::table('competencias')->truncate();
		\Illuminate\Support\Facades\DB::table('tipo_reactivos')->truncate();
		\Illuminate\Support\Facades\DB::table('estatus')->truncate();
		\Illuminate\Support\Facades\DB::table('profesores')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		factory(Competencia::class)->times(2)->create();
		factory(TipoReactivo::class)->times(2)->create();
		factory(Estatus::class)->times(2)->create();
		factory(Profesor::class)->times(2)->create();

		factory(Reactivo::class)->create([
			'competencia_id' => 1,
			'tipo_id' => 1,
			'estatus_id' => 1,
			'profesor_id' => 1,
		]);

		$this->json('DELETE','/api/reactivos/1')
		->assertStatus(204);
	}

	/** @test */
	public function it_deletes_a_reactivo_fail() {
		$this->json('DELETE','/api/reactivos/1')
		->assertStatus(404)
		->assertJson([
			'error' => 'Resource not found',
		]);;
	}


	/** @test */
	public function it_updates_a_reactivo_fail() {

		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		\Illuminate\Support\Facades\DB::table('competencias')->truncate();
		\Illuminate\Support\Facades\DB::table('tipo_reactivos')->truncate();
		\Illuminate\Support\Facades\DB::table('estatus')->truncate();
		\Illuminate\Support\Facades\DB::table('profesores')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		factory(Competencia::class)->times(2)->create();
		factory(TipoReactivo::class)->times(2)->create();
		factory(Estatus::class)->times(2)->create();
		factory(Profesor::class)->times(2)->create();

		factory(Reactivo::class)->create([
			'competencia_id' => 1,
			'tipo_id' => 1,
			'estatus_id' => 1,
			'profesor_id' => 1,
		]);

		$payload = [
			'competencia_id' => 23,
			'tipo_id' => 12,
			'estatus_id' => 11,
			'profesor_id' => 1,
			'pregunta' => 'pregunta',
			'respuesta' => 'lorem',
			'texto' => 'xd',
		];

		$this->json('PUT','/api/reactivos/1', $payload)
		->assertStatus(400)
		->assertJson([
			'error' => 'Query error',
		]);
	}
}
