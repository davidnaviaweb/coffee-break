<?php

namespace App\Utils;

use App\Models\Card;
use App\Models\Machine;
use App\Models\User;
use JetBrains\PhpStorm\ArrayShape;

class Events
{
    public static function format_login_response(Card $card)
    {
        $response = [
            'status' => $card->status
        ];

        switch (strtolower($card->status)) {
            case Card::ACTIVE:
                $response['credit'] = $card->balance;
                $response['name'] = $card->user->name;
                break;

            case Card::INACTIVE:
            case Card::BLOCKED:
                $response['error'] = __("Card is {$card->status}");
                break;
        }

        return $response;
    }

    /**
     * @param  Machine  $machine
     * @return array
     */
    #[ArrayShape(['products' => "array"])] public static function format_start_response(Machine $machine): array
    {
        $response = [
            'products' => []
        ];

        foreach ($machine->products as $product) {
            $allergies = [];
            foreach ($product->allergies->all() as $allergy) {
                $allergies[] = array_filter(
                    $allergy->toArray(),
                    fn($key) => in_array($key, ['id', 'name', 'image']),
                    ARRAY_FILTER_USE_KEY
                );
            }

            $response['products'][] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'image' => $product->image,
                'price' => $product->pivot->price,
                'stock' => $product->pivot->stock,
                'allergies' => $allergies
            ];
        }

        return $response;
    }

}