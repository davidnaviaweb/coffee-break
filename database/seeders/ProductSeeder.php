<?php

namespace Database\Seeders;

use App\Models\Allergy;
use App\Models\Machine;
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
            $allergies = fake()->randomElements(array_map(fn($item) => $item['id'], $allAllergies), rand(1, 3));
            $product->allergies()->sync($allergies);
        }

        $machines = Machine::all();

        foreach ($machines as $machine) {
            $products = fake()->randomElements(Product::all(), rand(3, 7));

            foreach ($products as $product) {
                $min = 0.70;
                $max = 2.50;

                $price = mt_rand($min * 10, $max * 10);
                $price = round($price * 20) / 200;

                $machine->products()->attach($product, [
                    'price' => number_format($price, 2, '.', ''),
                    'stock' => rand(0, 15)
                ]);
            }
        }
    }
}
