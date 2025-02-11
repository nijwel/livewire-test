<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory {
    protected $model = Category::class;

    public function definition(): array {
        $name = $this->faker->words( 3, true );

        return [
            'name'      => $name,
            'slug'      => Str::slug( $name ) . '-' . $this->faker->unique()->numberBetween( 1, 9999 ),
            'parent_id' => null,
            'status'    => $this->faker->randomElement( ['active', 'inactive'] ),
        ];
    }
}