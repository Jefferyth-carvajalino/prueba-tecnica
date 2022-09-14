<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'dni' => $this->faker->unique()->numberBetween(10000000, 99999999),
			'first_name' => $this->faker->name(),
			'last_name' => $this->faker->name(),
			'email' => $this->faker->unique()->safeEmail(),
			'address' => $this->faker->address(),
			'cell_phone' => $this->faker->phoneNumber(),
			'country' => $this->faker->country(),
			'category_id' => $this->faker->numberBetween(1, 3)
		];
	}
}
