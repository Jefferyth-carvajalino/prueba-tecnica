<?php

namespace Tests\Feature\Http\Controllers\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Faker\Factory;

class UserControllerTest extends TestCase
{
	use RefreshDatabase;

	/**
	 * @test
	 */
	public function can_create_user()
	{

		$this->seed();

		$faker = Factory::create();

		$response = $this->json('POST', '/api/v1/users', [
			'dni' => $dni = (string) $faker->unique()->numberBetween(10000000, 99999999),
			'first_name' => $first_name = $faker->name,
			'last_name' => $last_name = $faker->name,
			'email' => $email = $faker->unique()->safeEmail,
			'address' => $address = $faker->address,
			'cell_phone' => $cell_phone = $faker->numerify('##########'),
			'country' => $country = $faker->country,
			'category_id' => $category_id = $faker->numberBetween(1, 3),
		]);

		// \Log::info(1, [$response->getContent()]);

		$response->assertStatus(201)
			->assertJsonStructure([
				'id',
				'dni',
				'first_name',
				'last_name',
				'email',
				'address',
				'cell_phone',
				'country',
				'category_id',
			])
			->assertExactJson([
				'id' => 1,
				'dni' => $dni,
				'first_name' => $first_name,
				'last_name' => $last_name,
				'email' => $email,
				'address' => $address,
				'cell_phone' => $cell_phone,
				'country' => $country,
				'category_id' => $category_id,
			]);

		$this->assertDatabaseHas('users', [
			'dni' => $dni,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email' => $email,
			'address' => $address,
			'cell_phone' => $cell_phone,
			'country' => $country,
			'category_id' => $category_id
		]);
	}

	public function will_fail_with_a_409_if_user_we_want_to_insert_already_exist()
	{
		$this->seed();

		$faker = Factory::create();

		$response = $this->json('POST', '/api/v1/users', [
			'dni' => $dni = (string) $faker->unique()->numberBetween(10000000, 99999999),
			'first_name' => $first_name = $faker->name,
			'last_name' => $last_name = $faker->name,
			'email' => $email = $faker->unique()->safeEmail,
			'address' => $address = $faker->address,
			'cell_phone' => $cell_phone = $faker->phoneNumber,
			'country' => $country = $faker->country,
			'category_id' => $category_id = $faker->numberBetween(1, 3),
		]);

		$response->assertStatus(201)
			->assertJsonStructure([
				'id',
				'dni',
				'first_name',
				'last_name',
				'email',
				'address',
				'cell_phone',
				'country',
				'category_id',
				'created_at',
			])
			->assertExactJson([
				'id' => 1,
				'dni' => $dni,
				'first_name' => $first_name,
				'last_name' => $last_name,
				'email' => $email,
				'address' => $address,
				'cell_phone' => $cell_phone,
				'country' => $country,
				'category_id' => $category_id,
				'created_at' => (string) now()->toDateTimeString(),
			]);

		$this->assertDatabaseHas('users', [
			'dni' => $dni,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email' => $email,
			'address' => $address,
			'cell_phone' => $cell_phone,
			'country' => $country,
			'category_id' => $category_id
		]);

		$response2 = $this->json('POST', '/api/v1/users', [
			'dni' => $dni,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email' => $email,
			'address' => $address,
			'cell_phone' => $cell_phone,
			'country' => $country,
			'category_id' => $category_id
		]);

		$response2->assertStatus(409)
			->assertJsonStructure(['errror'])
			->assertExactJson([
				'error' => 'User already exist'
			]);
	}

	public function return_error_when_not_valid_create_user()
	{

		$this->seed();

		$faker = Factory::create();

		$response = $this->json('POST', '/api/v1/users', [
			'dni' => $dni = '',
			'first_name' => $first_name = $faker->name,
			'last_name' => $last_name = $faker->name,
			'email' => $email = $faker->unique()->safeEmail,
			'address' => $address = $faker->address,
			'cell_phone' => $cell_phone = $faker->numerify('#?########'),
			'country' => $country = $faker->country,
			'category_id' => $category_id = $faker->numberBetween(1, 3),
		]);

		// \Log::info(1, [$response->getContent()]);

		$response->assertStatus(422)
			->assertJsonStructure([
				'message',
				'errors'
			])
			->assertExactJson([
				'message' => 'The given data was invalid.',
				'errors' => [
					'*'
				]
			]);

		$this->assertDatabaseMissing('users', [
			'dni' => $dni,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email' => $email,
			'address' => $address,
			'cell_phone' => $cell_phone,
			'country' => $country,
			'category_id' => $category_id
		]);
	}
}
