<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory {
    protected $model = Post::class;

    public function definition(): array {
        $name = $this->faker->words( 3, true );

        return [
            'category_id' => rand( 1, 10 ),
            'name'        => $name,
            'slug'        => Str::slug( $name ),
            'price'       => $this->faker->randomFloat( 2, 10, 1000 ),
            'quantity'    => $this->faker->numberBetween( 1, 100 ),
            'description' => $this->faker->sentence(),
            'image'       => $this->faker->imageUrl( 200, 200, 'posts', true ),
            'status'      => $this->faker->randomElement( ['active', 'inactive'] ),
        ];
    }
}