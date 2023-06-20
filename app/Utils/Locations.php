<?php

namespace App\Utils;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Locations
{
    /**
     * Get a city/town name from latitude and longitude
     *
     * @param  number  $lat
     * @param  number  $long
     * @param  bool  $formatted
     * @return mixed
     * @throws GuzzleException
     */
    public static function get_full_address($lat, $long): mixed
    {
        $client = new Client();
        $url = "https://api.opencagedata.com/geocode/v1/json?q=".urlencode($lat.','.$long)."&key=".env('OPENCAGE_API_KEY')."&language=es&pretty=1";
        $response = $client->request('GET', $url);
        $body = json_decode($response->getBody());

        if ($body->total_results > 0) {
            $result = (array) $body->results[0]->components;
            $result['formatted'] = $body->results[0]->formatted;

            return (object) $result;

        } else {
            return null;
        }
    }

    /**
     * Get latitude and longitude from a city/town name
     *
     * @param  string  $location
     *
     * @return array|null
     * @throws GuzzleException
     */
    public static function get_lat_lng(string $location): ?array
    {
        $apiKey = env('OPENCAGE_API_KEY');
        $client = new Client();
        $url = "https://api.opencagedata.com/geocode/v1/json?q=".urlencode($location)."&key=".$apiKey."&language=native&pretty=1";
        $response = $client->request('GET', $url);
        $body = json_decode($response->getBody());

        if ($body->total_results > 0) {
            $latitude = $body->results[0]->geometry->lat;
            $longitude = $body->results[0]->geometry->lng;

            return ['lat' => $latitude, 'lng' => $longitude];
        } else {
            return null;
        }
    }

    /**
     * Calculate the distance between two locations
     *
     * @param $latitude1
     * @param $longitude1
     * @param $latitude2
     * @param $longitude2
     *
     * @return float|int
     */
    public static function calculate_distance($latitude1, $longitude1, $latitude2, $longitude2): float|int
    {
        $earthRadius = 6371;

        $deltaLatitude = deg2rad($latitude2 - $latitude1);
        $deltaLongitude = deg2rad($longitude2 - $longitude1);

        $a = sin($deltaLatitude / 2) * sin($deltaLatitude / 2) +
            cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) *
            sin($deltaLongitude / 2) * sin($deltaLongitude / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;

        return $distance;
    }
}