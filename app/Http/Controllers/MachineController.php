<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMachine;
use App\Models\Location;
use App\Models\Machine;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MachineController extends Controller
{
    /**
     * Display the machine's index.
     */
    public function index(Request $request): View
    {
        return view('machines.index', [
            'machines' => Machine::orderBy('updated_at', 'desc')->paginate(),
            'locations' => Location::all()
        ]);
    }

    /**
     * Create a new machine.
     */
    public function store(StoreMachine $request)
    {
        Machine::create($request->all());

        return redirect(route('machines.index'));
    }

    /**
     * Display the machine's edit form.
     */
    public function edit(Request $request, Machine $machine): View
    {
        $locations = Location::all();
        $allProducts = Product::all();
        $products = $machine->products()->allRelatedIds();

        return view('machines.edit', compact('machine', 'locations', 'allProducts', 'products'));
    }

    /**
     * Update a machine.
     */
    public function update(StoreMachine $request, Machine $machine): RedirectResponse
    {
        $machine->update($request->all());
        $machine->allergies()->sync($request->products);

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
}
