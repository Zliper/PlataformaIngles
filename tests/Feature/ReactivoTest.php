<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class ReactivoTest extends TestCase
{

	use RefreshDatabase;

	private $table = "reactivos";
	private $url = "/api/reactivos";

	/** @test */
	function db_has_reactivos() {

		$count = DB::table('reactivos')->count();

		$this->assertEquals(10, $count);
	}


	/** @test */
	function it_shows_the_reactivos_list_in_json() {

	}
}
