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

    public function machines()
    {
        return $this->belongsToMany(Machine::class, 'machine_product')
            ->withPivot('price', 'stock')
            ->withTimestamps();
    }
}
