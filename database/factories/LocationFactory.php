<?php

namespace Database\Factories;

use App\Models\Location;
use App\Utils\Locations;
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
        $lat = fake()->latitude($min = 37.5, $max = 43);
        $lng = fake()->longitude($min = -6, $max = 0);

        $full_address = Locations::get_full_address($lat, $lng);

        return [
            'name' => fake()->word,
            'description' => $full_address->formatted ?? fake()->address,
            'address' => $full_address->road ?? $full_address->locality ?? fake()->streetAddress,
            'city' => $full_address->village ?? fake()->city,
            'state' => $full_address->state_district ?? fake()->state,
            'zip' => $full_address->postcode ?? fake()->postcode,
            'country' => 'España',
            'lat' => $lat,
            'lng' => $lng,
        ];
    }
}
