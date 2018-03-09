<?php	

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\models\Competencia;
use App\User; 


class CompetenciaTest extends TestCase
{
	use RefreshDatabase;


	/** @test */
	public function it_displays_list_competencias() {
		factory(Competencia::class)->times(2)->create();


		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('GET','/api/competencias', [], $headers)
		->assertStatus(200);
	}  


	/** @test */
	public function it_gets_404() {
		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('GET','/api/competencias/3453', [], $headers)
		->assertStatus(404);
	} 
}