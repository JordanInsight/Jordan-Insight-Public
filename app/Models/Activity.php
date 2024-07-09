<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'activity_name',
        'description',
        'website',
        'activity_type',
        'price',
        'image',
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
