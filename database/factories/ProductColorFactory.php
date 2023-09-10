<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductColor>
 */
class ProductColorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
         'product_id' => $this->faker->numberBetween(1, 50),
            //'product_id' => 5,

            'color' => $this->faker->hexColor,
        ];
    }
}
