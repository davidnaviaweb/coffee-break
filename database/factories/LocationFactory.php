<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    protected $model = Location::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word,
            'description' => fake()->sentence,
            'address' => fake()->streetAddress,
            'city' => fake()->city,
            'state' => fake()->state,
            'zip' => fake()->postcode,
            'country' => 'España',
            'lat' => fake()->latitude($min = 37.5, $max = 43),
            'lng' => fake()->longitude($min = -6, $max = 0),
        ];
    }
}
