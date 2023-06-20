<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'location', 'address', 'city', 'state', 'zip', 'country', 'lat', 'lng'
    ];
    protected $guarded = [];
    protected $perPage = 10;
}
