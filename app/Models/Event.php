<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public const PURCHASE = 'purchase';
    public const LOGIN = 'login';
    public const LOGOUT = 'logout';
    public const START = 'start';
    public const STOP = 'stop';

    public const TYPES = [
        self::PURCHASE,
        self::LOGIN,
        self::LOGOUT,
        self::START,
        self::STOP
    ];

    protected $fillable = ['type', 'machine_id', 'data'];
    protected $perPage = 50;
    protected $casts = [
        'data' => 'json',
    ];

    public function setDataAttribute($value)
    {
        $this->attributes['data'] = $value ?? [];
    }
}
