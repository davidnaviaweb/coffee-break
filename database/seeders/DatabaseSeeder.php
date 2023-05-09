<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Location;
use App\Models\Machine;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Demo',
            'email' => 'demo@demo.com',
            'password' => bcrypt('demodemo')
        ]);

        // Cards
        Card::factory(20)->create();

        // Allergies & products
        (new AllergySeeder)->run();
        (new ProductSeeder)->run();

        // Machines & locations
        Location::factory(5)->create();
        Machine::factory(50)->create();

    }
}
