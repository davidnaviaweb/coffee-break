<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\EventResource;
use App\Models\Card;
use App\Models\Event;
use App\Models\Machine;
use App\Models\Product;
use App\Utils\Events;
use Exception;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return EventResource::collection(Event::latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payload = (object) $request->json()->all();

        try {
            if (!in_array($payload->type, Event::TYPES)) {
                throw new Exception(__("Type {$payload->type} is not valid."));
            }

            switch ($payload->type ?? '') {
                case     Event::PURCHASE:
                    $machine = Machine::find($payload->machine_id);

                    // Update product
                    $product = $machine->products()->find($payload->data['product_id']);

                    // Update product
                    $machine->products()->syncWithoutDetaching([
                        $product->id => [
                            'price' => $product->pivot->price,
                            'stock' => ($product->pivot->stock - 1)
                        ]
                    ]);

                    // Withdraw money from the card
                    $card = Card::where('serial_number', '=',$payload->data['card_number'])->first();
                    if (!is_a($card, Card::class)) {
                        throw new Exception(__("Card with number {$payload->data['card_number']} does not exists"));
                    }
                    $card->balance = $card->balance - $product->pivot->price;
                    $card->save();

                    $response = Events::format_start_response($machine);

                    break;
                case Event::LOGIN:
                    $card_number = $payload->data['card_number'] ?? 'unknown';
                    $card = Card::where('serial_number', '=', $card_number)->first();

                    if (!is_a($card, Card::class)) {
                        throw new Exception(__("Card with number {$card_number} does not exists"));
                    }

                    $response = Events::format_login_response($card);
                    break;
                case    Event::LOGOUT:
                    $card_number = $payload->data['card_number'] ?? 'unknown';
                    $card = Card::where('serial_number', '=', $card_number)->first();

                    if (!is_a($card, Card::class)) {
                        throw new Exception(__("Card with number {$card_number} does not exists"));
                    }

                    $response = ['message' => __("Logout successful")];
                    break;
                case Event::START:
                    $machine = Machine::find($payload->machine_id);

                    if (!is_a($machine, Machine::class)) {
                        throw new Exception(__("Machine with id {$payload->machine_id} does not exists"));
                    }

                    $response = Events::format_start_response($machine);
                    break;
                case Event::STOP:
                    $response = ['message' => __("Machine stopped")];
                    break;
            }

            Event::create($request->all());

            return response()->json($response ?? []);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
