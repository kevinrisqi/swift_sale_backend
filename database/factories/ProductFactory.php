<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'purchase_price' => $this->faker->randomNumber(5),
            'selling_price' => $this->faker->randomNumber(5),
            'description' => $this->faker->text,
            'stock' => $this->faker->randomNumber(2),
            'image' => $this->faker->imageUrl(),
            'category' => $this->faker->randomElement(['snack', 'food', 'drink']),
        ];
    }
}
