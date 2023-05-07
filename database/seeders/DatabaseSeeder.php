<?php

namespace Database\Seeders;

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

        Location::factory(5)->create();
        Machine::factory(5)->create();
    }
}
