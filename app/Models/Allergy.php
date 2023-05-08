<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allergy extends Model
{
    use HasFactory;

    private const ALLERGIES_DIR = '/assets/img/allergies/';

    /**
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return new Attribute(
            get: fn($value) => ucfirst($value)
        );
    }

    /**
     * @return array
     */
    public static function getAllergiesFromDir(): array
    {
        $allergies = [];
        foreach (glob(public_path().self::ALLERGIES_DIR.'*.png') as $allergy) {
            $filename = pathinfo($allergy)['filename'];
            $allergies[] = [
                'name' => __(str_replace('-', ' ', substr($filename, strrpos($filename, '_') + 1))),
                'image' => url('/').substr($allergy, strlen(public_path())),
            ];
        }

        return $allergies;
    }
}
