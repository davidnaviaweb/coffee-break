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
        $allAllergies = Allergy::all('id')->toArray();

        for ($i = 1; $i <= 10; $i++) {
            $product = Product::create([
                'name' => fake()->word,
                'image' => fake()->imageUrl(400, 400),
            ]);
            $allergies = fake()->randomElements(array_map(fn($item) => $item['id'], $allAllergies), 3);
            $product->allergies()->sync($allergies);
        }
    }
}
