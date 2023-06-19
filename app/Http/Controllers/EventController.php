<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEvent;
use App\Models\Event;
use App\Models\Product;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public static function format_data($event)
    {
        $data = json_decode($event->data);
        switch ($event->type) {
            case     Event::PURCHASE:
                $product = Product::find($data->product_id);
                echo "{$product->name} at {$data->price}";

//                $data = json_encode([
//                    'product_id' => $product->id,
//                    'price' => $product->pivot->price,
//                ]);
                break;
            case    Event::LOGIN:
                echo "{$data->card_serial_number} with status {$data->card_status}";
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
                echo "{$data->card_serial_number} with status {$data->card_status}";

//                $data = json_encode(
//                    [
//                        'card_id' => $card->id,
//                        'card_serial_number' => $card->serial_number,
//                        'card_status' => $card->status
//                    ]
//                );
                break;
            case    Event::START:
            case    Event::STOP:
//                $data = json_encode([])
        };
    }


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
}
