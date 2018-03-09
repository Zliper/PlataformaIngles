<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\models\Estatus;
use App\User;


class EstatusTest extends TestCase
{

	use RefreshDatabase;
    

    /** @test */
    public function it_displays_estatus() {
    	factory(Estatus::class)->times(2)->create();

    	$user = factory(User::class)->create([
			'email' => 'root_test@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('GET','/api/estatus',[], $headers)
			->assertStatus(200);

    }

    /** @test */
    public function it_gets_404() {
    	$user = factory(User::class)->create([
			'email' => 'root_test@gmail.com',
		]);

		$token = $user->generateToken();

		$headers = ['Authorization' => "Bearer $token"];

		$this->json('GET','/api/estatus/43',[], $headers)
			->assertStatus(404);
    }
}
