<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'location_id'];
    protected $guarded = [];
    protected $perPage = 10;

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    // Attributes
    protected function name(): Attribute
    {
        return new Attribute(
            get: fn($value) => ucfirst($value),
            set: fn($value) => strtolower($value)
        );
    }

    protected function description(): Attribute
    {
        return new Attribute(
            get: fn($value) => ucfirst($value),
            set: fn($value) => strtolower($value)
        );
    }
}
