<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocation;
use App\Models\Location;
use App\Utils\Locations;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LocationController extends Controller
{
    public static function getMarkers()
    {
        $markers = Location::all()->toArray();
        foreach ($markers as &$marker) {
            $marker['editlink'] = route('locations.edit', $marker['id']);
        }

        return $markers;
    }

    /**
     * Display the location's index.
     */
    public function index(Request $request): View
    {
        return view('locations.index', [
            'locations' => Location::orderBy('updated_at', 'desc')->paginate(),
        ]);
    }

    /**
     * Create a new location.
     */
    public function store(StoreLocation $request)
    {
        $data = $this->getLocationData($request);

        Location::create($data);

        return  redirect()->route('locations.index')
            ->with('success', sprintf(__('%s created successfully'), __('Location')));;
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
    public function update(StoreLocation $request, Location $location): RedirectResponse
    {
        $data = $this->getLocationData($request);

        $location->update($data);

        return redirect()->route('locations.edit', compact('location'))
            ->with('success', sprintf(__('%s updated successfully'), __('Location')));
    }

    /**
     * Delete a location.
     */
    public function destroy(Location $location)
    {
        try {
            $location->delete();
            return redirect()->route('locations.index')
                ->with('success', sprintf(__('%s deleted successfully'), __('Location')));
        } catch (Exception $exception) {
            return redirect()->route('locations.index')
                ->with('error', __('You need to remove all machines associated to this location before deleting'));
        }
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $client = new Client(['base_uri' => 'https://api.opencagedata.com/geocode/v1/']);
        $response = $client->get('json', [
            'query' => [
                'q' => $query,
                'key' => env('OPENCAGE_API_KEY'),
                'language' => 'es',
                'countrycode' => 'es'
            ],
        ]);

        $data = json_decode($response->getBody()->getContents(), true);
        $predictions = [];

        foreach ($data['results'] as $result) {
            $formatted = $result['formatted'];
            $predictions[] = $formatted;
        }

        return response()->json($predictions);
    }

    /**
     * @param  StoreLocation  $request
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getLocationData(StoreLocation $request): array
    {
        $coordinates = Locations::get_lat_lng($request->location);
        $address = Locations::get_full_address($coordinates['lat'], $coordinates['lng']);
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'location' => $address->formatted,
            'address' => $address->road ?? '',
            'city' => $address->city ?? $address->town ?? $address->village ?? '',
            'state' => $address->state_district ?? $address->state,
            'zip' => $address->postcode,
            'country' => $address->country,
            'lat' => $coordinates['lat'],
            'lng' => $coordinates['lng'],
        ];
        return $data;
    }
}
