<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMachine;
use App\Models\Machine;
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
        return view('machines.edit', compact('machine'));
    }

    /**
     * Update a machine.
     */
    public function update(StoreMachine $request, Machine $machine): View
    {
        $machine->update($request->all());

        return view('machines.edit', compact('machine'));
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
