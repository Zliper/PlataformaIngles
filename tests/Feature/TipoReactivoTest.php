<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\models\TipoReactivo;
use App\User;


class TipoReactivoTest extends TestCase
{
    use RefreshDatabase;
    

    /** @test */
    public function it_displays_tipos() {
    	factory(TipoReactivo::class)->times(2)->create();

    	$user = factory(User::class)->create([
			'email' => 'root_test@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('GET','/api/tipos',[], $headers)
			->assertStatus(200);

    }

    /** @test */
    public function it_gets_404() {
    	$user = factory(User::class)->create([
			'email' => 'root_test@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('GET','/api/tipos/43',[], $headers)
			->assertStatus(404);
    }
}
