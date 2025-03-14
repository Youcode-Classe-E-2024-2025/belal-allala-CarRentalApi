<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'year',
        'color',
        'registration_number',
        'mileage',
        'daily_rate',
        'availability',
        'image_path',
    ];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}