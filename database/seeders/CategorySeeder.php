<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$dataToSeed = array(
			[
				'name' => 'CLIENTE'
			],
			[
				'name' => 'PROVEEDOR'
			],
			[
				'name' => 'FUNCIONARIO INTERNO'
			]
		);

		foreach ($dataToSeed as $category) {
			Category::create($category);
		}
	}
}
