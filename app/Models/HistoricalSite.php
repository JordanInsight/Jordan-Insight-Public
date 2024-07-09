<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricalSite extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'site_name',
        'description',
        'website',
        'image',
        'entry_fees',
        'opening_hours',
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
