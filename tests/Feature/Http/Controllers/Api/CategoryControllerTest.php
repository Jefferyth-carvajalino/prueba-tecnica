<?php

namespace Tests\Feature\Http\Controllers\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabaseState;

class CategoryControllerTest extends TestCase
{
	use RefreshDatabase;

	/**
	 * @test
	 */
	public function can_create_all_categories()
	{

		$this->seed();

		$name = 'CLIENTE';

		$this->assertDatabaseHas('categories', [
			'name' => $name
		]);
	}

	/**
	 * @test
	 */
	public function can_return_a_category()
	{
		// Given
		$this->seed();
		$categoryId = 1;
		$categoryName = 'CLIENTE';

		// When
		$response = $this->json('GET', "/api/v1/categories/$categoryId");

		// \Log::info(1, [$response->getContent()]);

		// Then
		$response->assertStatus(200)
			->assertJsonStructure([
				[
					'id',
					'name',
					'created_at',
				]
			]);
	}

	/**
	 * @test
	 */
	public function can_return_all_categories()
	{
		$this->seed();

		$response = $this->json('GET', "/api/v1/categories");

		// \Log::info(1, [$response->getContent()]);

		$response->assertStatus(200)
			->assertJsonStructure([
				'data' => [
					'*' => [
						'id',
						'name',
						'created_at',
					]
				]
			]);
	}
}
