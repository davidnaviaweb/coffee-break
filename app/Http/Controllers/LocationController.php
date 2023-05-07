<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocation;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LocationController extends Controller
{
    /**
     * Display the location's index.
     */
    public function index(Request $request): View
    {
        return view('locations.index', [
            'locations' => Location::paginate(),
        ]);
    }

    /**
     * Create a new location.
     */
    public function store(StoreLocation $request)
    {
        Location::create($request->all());

        return redirect(route('locations.index'));
    }


    /**
     * Display the location's edit form.
     */
    public function edit(Request $request, Location $location): View
    {
        return view('locations.edit', compact('location'));
    }


    /**
     * Update a location.
     */
    public function update(StoreLocation $request, Location $location): View
    {
        $location->update($request->all());

        return view('locations.edit', compact('location'));
    }

    /**
     * Delete a location.
     */
    public function destroy(Location $location)
    {
        $location->delete();

        return redirect(route('locations.index'));
    }
}
