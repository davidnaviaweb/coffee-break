<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\EventResource;
use App\Models\Event;
use App\Models\Machine;
use App\Models\Product;
use App\Utils\Machines;
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
        $data = $request->json()->all();

        $event = Event::create($request->all());

        switch ($event->type) {
            case     Event::PURCHASE:
////                $product = Product::find($data->product_id);
////                echo "{$product->name} at {$data->price}";
////
//////                $data = json_encode([
//////                    'product_id' => $product->id,
//////                    'price' => $product->pivot->price,
//////                ]);
                break;
            case    Event::LOGIN:
//                echo "{$data->card_number} with status {$data->card_status}";
////
////                $data = json_encode(
////                    [
////                        'card_id' => '',
////                        'card_serial_number' => $card->serial_number,
////                        'card_status' => $card->status,
////                        'response' => $response ?? []
////                    ]
////                );
                break;
//            case    Event::LOGOUT:
//                echo "{$data->card_number} with status {$data->card_status}";
//
////                $data = json_encode(
////                    [
////                        'card_id' => $card->id,
////                        'card_number' => $card->serial_number,
////                        'card_status' => $card->status
////                    ]
////                );
                break;
            case    Event::START:
                $machine = Machine::find($event->machine_id);
                $response = Machines::format_start_response($machine);

                return response()->json($response);
            case    Event::STOP:
                return response()->json(['message' => __("Machine stopped")]);
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
