<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    public const SERIAL_NUMBER_LENGTH = 12;

    public const INACTIVE = 'inactive';
    public const ACTIVE = 'active';
    public const BLOCKED = 'blocked';
    public const STATI = [
        self::INACTIVE,
        self::ACTIVE,
        self::BLOCKED,
    ];

    protected $fillable = ['serial_number', 'balance', 'user_id'];
    protected $guarded = ['status'];
    protected $perPage = 10;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Attributes
    public function status(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst($value),
            set: fn($value) => strtolower($value),
        );
    }

    public function balance(): Attribute
    {
        return Attribute::make(
            get: fn($value) => floatval($value),
            set: fn($value) => floatval($value),
        );
    }
}
