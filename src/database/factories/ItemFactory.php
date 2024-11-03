<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'user_id' => \App\Models\User::factory(),
			'title' => $this->faker->word,
			'description' => $this->faker->sentence,
			'price' => $this->faker->randomFloat(2, 10, 1000),
			'image_url' => $this->faker->imageUrl(320, 240, 'technics', true, 'Faker'),
			'is_sold' => $this->faker->boolean,
			'created_at' => now(),
			'updated_at' => now(),
	];
	}
}
