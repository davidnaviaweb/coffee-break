<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Event;
use App\Models\Machine;
use Illuminate\Database\Seeder;
use function __;
use function fake;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 100; $i++) {
            $type = fake()->randomElement(Event::TYPES);
            $machine = fake()->randomElement(Machine::all());
            $product = fake()->randomElement($machine->products);

            $card = fake()->randomElement(Card::all());

            switch ($card->status) {
                case Card::INACTIVE:
                    $response = __('Card is inactive');
                    break;
                case Card::ACTIVE:
                    $response = $card->balance;
                    break;
                case Card::BLOCKED:
                    $response = __('Card is blocked');
                    break;
            };

            $data = match ($type) {
                Event::PURCHASE => json_encode([
                    'product_id' => $product->id,
                    'price' => $product->pivot->price,
                ]),
                Event::LOGIN => json_encode(
                    [
                        'card_id' => $card->id,
                        'card_number' => $card->serial_number,
                        'card_status' => $card->status,
                        'response' => $response ?? []
                    ]
                ),
                Event::LOGOUT => json_encode(
                    [
                        'card_id' => $card->id,
                        'card_number' => $card->serial_number,
                        'card_status' => $card->status
                    ]
                ),
                Event::START, Event::STOP => json_encode([])
            };

            Event::create(
                [
                    'machine_id' => $machine->id,
                    'type' => $type,
                    'data' => $data
                ]
            );
        }
    }
}
