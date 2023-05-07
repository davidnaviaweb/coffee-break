<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMachine;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MachineController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request): View
    {
        return view('machines.index', [
            'machines' => Machine::paginate(),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request, Machine $machine): View
    {
        return view('machines.edit', compact('machine'));
    }

    /**
     * Display the user's profile form.
     */
    public function store(StoreMachine $request): View
    {
        $machine = Machine::create($request->all());

        return self::index($request);
    }

    /**
     * Display the user's profile form.
     */
    public function update(StoreMachine $request, Machine $machine): View
    {
        $machine->update($request->all());

        return view('machines.edit', compact('machine'));
    }
}
