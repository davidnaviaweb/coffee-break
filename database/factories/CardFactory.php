<?php

namespace Database\Factories;

use App\Http\Controllers\CardController;
use App\Models\Card;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Card>
 */
class CardFactory extends Factory
{
    protected $model = Card::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'serial_number' => CardController::getNewSerialNumber(),
            'user_id' => fake()->randomElement(User::all()),
            'balance' => fake()->numberBetween(0, 30),
            'status' => fake()->randomElement(Card::STATI),
        ];
    }
}
