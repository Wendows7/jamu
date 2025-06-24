<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
            'name' => fake()->name(),
            'description' => fake()->text(),
            'image' => "assets/images/product-image/66_1.jpg",
            'image_2' => "assets/images/product-image/66_1.jpg",
            'image_3' => "assets/images/product-image/66_1.jpg",
            'category_id' => 1
        ];
    }
}
