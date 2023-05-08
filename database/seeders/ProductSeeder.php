<?php

namespace Database\Seeders;

use App\Models\Allergy;
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
            $product = Product::create([
                'name' => fake()->word,
                'price' => fake()->randomFloat(2, 0.50, 3),
                'image' => fake()->imageUrl(400, 400),
            ]);
            $allergies = fake()->randomElements(array_map(fn($item) => $item['id'], Allergy::all('id')->toArray()), 3);
            $product->allergies()->sync($allergies);
        }
    }
}
