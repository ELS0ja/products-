<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$faker = Faker::create();

		// Insert the specific product requested by the user
		DB::table('products')->insert([
			'name' => 'phone Accessories',
			'slug' => Str::slug('phone Accessories') . '-' . Str::random(6),
			'description' => 'Assorted accessories and add-ons',
			'price' => 250.00,
			'created_at' => now(),
			'updated_at' => now(),
		]);

		for ($i = 0; $i < 10; $i++) {
			DB::table('products')->insert($this->productData($faker));
		}
	}

	/**
	 * Return an array of product data for insertion.
	 */
	protected function productData($faker): array
	{
		$name = $faker->words(3, true);
		$price = $faker->randomFloat(2, 1, 200);

		return [
			'name' => $name,
			'slug' => Str::slug($name) . '-' . Str::random(6),
			'description' => $faker->sentence(12),
			'price' => $price,
			'created_at' => now(),
			'updated_at' => now(),
		];
	}
}
