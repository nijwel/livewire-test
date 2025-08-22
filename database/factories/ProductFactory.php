<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory {
    protected $model = Product::class;

    public function definition(): array {
        return [
            'name'        => $this->faker->words( 3, true ),
            'price'       => $this->faker->randomFloat( 2, 10, 1000 ),
            'quantity'    => $this->faker->numberBetween( 1, 100 ),
            'description' => $this->faker->sentence(),
            // Faker image URL (placeholder)
            'image'       => $this->faker->imageUrl( 200, 200, 'products', true ),
        ];
    }
}