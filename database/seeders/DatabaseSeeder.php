<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Machine;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Hashing\BcryptHasher;

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

        Machine::factory(10)->create();
    }
}
