<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $guarded = [];
    protected $perPage = 10;

    public function allergies()
    {
        return $this->belongsToMany(Allergy::class);
    }

    // Attributes
    protected function name(): Attribute
    {
        return new Attribute(
            get: fn($value) => ucfirst($value),
            set: fn($value) => strtolower($value)
        );
    }
}
