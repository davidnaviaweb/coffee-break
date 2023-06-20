<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEvent;
use App\Models\Event;
use App\Models\Machine;
use App\Models\Product;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display the event's index.
     */
    public function index(Request $request)
    {
        return view('events.index', [
            'events' => Event::orderBy('created_at', 'desc')->paginate(),
        ]);
    }

    /**
     * Create a new event.
     */
    public function store(Request $request)
    {
        Event::create($request->all());

        return redirect(route('events.index'));
    }

    public static function format_data($event)
    {
        $data = (object) $event->data;
        switch ($event->type) {
            case     Event::PURCHASE:
                $machine = Machine::find($event->machine_id);
                $product = $machine->products()->find($data->product_id);
                echo "{$product->name} at {$product->pivot->price}";

//                $data = json_encode([
//                    'product_id' => $product->id,
//                    'price' => $product->pivot->price,
//                ]);
                break;
            case    Event::LOGIN:
                echo "{$data->card_number}";
//
//                $data = json_encode(
//                    [
//                        'card_id' => '',
//                        'card_serial_number' => $card->serial_number,
//                        'card_status' => $card->status,
//                        'response' => $response ?? []
//                    ]
//                );
                break;
            case    Event::LOGOUT:
                echo "{$data->card_number} on {$data->status}";

//                $data = json_encode(
//                    [
//                        'card_id' => $card->id,
//                        'card_number' => $card->serial_number,
//                        'card_status' => $card->status
//                    ]
//                );
                break;
            case    Event::START:
            case    Event::STOP:
//                $data = json_encode([])
        };
    }

}
