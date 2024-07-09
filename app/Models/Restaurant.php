<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'restaurant_name',
        'cuisine',
        'description',
        'website',
        'image',
        'min_price',
        'max_price',
        'rating',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function city()
    {
        return $this->location->belongsTo(City::class);
    }
}
