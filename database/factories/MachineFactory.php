<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Machine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class MachineFactory extends Factory
{
    protected $model = Machine::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $locations = Location::all();

        return [
            'name' => fake()->word,
            'description' => fake()->sentence,
            'location_id' => fake()->randomElement($locations)
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
