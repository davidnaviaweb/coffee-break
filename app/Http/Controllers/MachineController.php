<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMachine;
use App\Models\Location;
use App\Models\Machine;
use App\Models\Product;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Validator;

class MachineController extends Controller
{
    /**
     * Display the machine's index.
     */
    public function index(Request $request): View
    {
        $machines = Machine::orderBy('updated_at', 'desc')->paginate();
        $locations = Location::all();

        return view('machines.index', compact('machines', 'locations'));
    }

    /**
     * Create a new machine.
     */
    public function store(StoreMachine $request)
    {
        Machine::create($request->all());

        $machines = Machine::orderBy('updated_at', 'desc')->paginate();
        $locations = Location::all();

        return redirect()->route('machines.index', compact('machines', 'locations')
        )->with('success', sprintf(__('%s updated successfully'), __('Machine')));
    }

    /**
     * Display the machine's edit form.
     */
    public function edit(Request $request, Machine $machine): View
    {
        $locations = Location::all();
        $allProducts = Product::all();
        $products = $machine->products;

        return view('machines.edit', compact('machine', 'locations', 'allProducts', 'products'));
    }

    /**
     * Update a machine.
     */
    public function update(StoreMachine $request, Machine $machine): RedirectResponse
    {
        $machine->update($request->all());

        return redirect()->route('machines.index')
            ->with('success', sprintf(__('%s updated successfully'), __('Machine')));
    }

    /**
     * Delete a machine.
     */
    public function destroy(Machine $machine)
    {
        $machine->delete();

        return redirect(route('machines.index'));
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function addProduct(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'price' => 'required|numeric|min:0.05',
            'stock' => 'required|numeric',
        ], [
            'product_id.required' => __('Please select a product'),
            'price.required' => __('Please set a price'),
            'price.numeric' => __('Please set a price with a decimal number'),
            'price.min' => __('Minimum price is 0.05'),
            'stock.required' => __('Please set stock'),
            'stock.numeric' => __('Please set stock with numbers'),

        ]);

        if ($validator->passes()) {
            $machine = Machine::find($request->machine_id);
            $product = Product::find($request->product_id);

            if (in_array($product->id, $machine->products()->allRelatedIds()->toArray())) {
                return response()->json(['error' => ['product_id' => [__('This product already exists in this machine')]]]);
            }
            // Convert price to float with 2 decimals
            $price = number_format($request->price, 2, '.', '');

            // Attach product to machine
            $machine->products()->attach($product, [
                'price' => $price,
                'stock' => $request->stock
            ]);

            // Save machine
            $machine->save();

            // Return response
            $response = [
                'product_id' => $product->id,
                'image' => url($product->image),
                'name' => $product->name,
                'price' => $price,
                'stock' => $request->stock,
            ];

            return response()->json(['success' => $response]);
        }

        return response()->json(['error' => $validator->errors()->toArray()]);
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function updateProduct(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'price' => 'required|numeric|min:0.05',
            'stock' => 'required|numeric',
        ], [
            'price.required' => __('Please set a price'),
            'price.numeric' => __('Please set a price with a decimal number'),
            'price.min' => __('Minimum price is 0.05'),
            'stock.required' => __('Please set stock'),
            'stock.numeric' => __('Please set stock with numbers'),
        ]);

        if ($validator->passes()) {
            try {
                $machine = Machine::find($request->machine_id);

                // Convert price to float with 2 decimals
                $price = number_format($request->price, 2, '.', '');

                // Update product
                $machine->products()->syncWithoutDetaching([
                    $request->product_id => [
                        'price' => $price,
                        'stock' => $request->stock
                    ]
                ]);

                // Save machine
                $machine->save();

                return response()->json([
                    'success' => [
                        'price' => $price,
                        'stock' => $request->stock,
                    ]
                ]);

            } catch (Exception $exception) {
                return response()->json(['error' => $exception->getMessage()]);
            }
        }
        return response()->json(['error' => $validator->errors()->toArray()]);


    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function deleteProduct(Request $request): JsonResponse
    {
        try {
            $machine = Machine::find($request->machine_id);
            $machine->products()->detach($request->product_id);
            $machine->save();

            return response()->json(['success' => true]);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }
}
