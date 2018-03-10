<?php	

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\models\Competencia;
use \Illuminate\Support\Facades\DB;
use App\User; 


class CompetenciaTest extends TestCase
{
	use RefreshDatabase;


	/** @test */
	public function it_displays_list_competencias() {

		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('competencias')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

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

		DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
		DB::table('competencias')->truncate();
		DB::table('users')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('GET','/api/competencias/0', [], $headers)
		->assertStatus(404);
	} 
}