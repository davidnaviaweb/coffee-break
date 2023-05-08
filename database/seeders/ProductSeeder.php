<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'name' => fake()->word,
                'price' => fake()->randomFloat(2, 0.50, 3),
                'thumbnail' => fake()->imageUrl(400, 400),
            ]);
        }
    }
}
