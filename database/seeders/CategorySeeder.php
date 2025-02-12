<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Category::factory()
            ->count( 1 )
            ->create()
            ->each( function ( $parent ) {
                Category::factory()
                    ->count( 3 )
                    ->create( [
                        'parent_id' => $parent->id,
                    ] );
            } );
    }
}
