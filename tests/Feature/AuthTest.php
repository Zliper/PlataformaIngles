<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class AuthTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function loginSuccessfully() {
		$user = factory(User::class)->create([
			'email' => 'root@gmail.com',
			'password' => bcrypt('loremroot'),
		]);

		$payload = ['email' => $user->email, 'password' => 'loremroot'];

		$this->json('POST','/api/login', $payload)
			->assertStatus(200)
			->assertJsonStructure([
				'data' => [
					'id',
					'name',
					'email',
					'api_token',
				],
			]);
	}
}
