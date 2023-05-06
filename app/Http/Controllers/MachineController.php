<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class MachineController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function list(Request $request): View
    {
        return view('machines.index', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('machines.edit', [
            'machine' => $request,
        ]);
    }



}