<?php

namespace App\Http\Controllers;

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
    public function store(Request $request): View
    {
        $request->validate(
            [
                'name' => 'required',
                'description' => 'required',
            ]
        );

        $machine = new Machine();
        $machine->name = $request->post('name');
        $machine->description = $request->post('description');
        $machine->save();

        return self::index($request);
    }

    /**
     * Display the user's profile form.
     */
    public function update(Request $request, Machine $machine): View
    {
        $request->validate(
            [
                'name' => 'required',
                'description' => 'required',
            ]
        );

        $machine->name = $request->name;
        $machine->description = $request->description;
        $machine->save();

        return view('machines.edit', compact('machine'));
    }
}
