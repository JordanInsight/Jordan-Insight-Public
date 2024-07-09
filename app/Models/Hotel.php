<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'location_id',
        'hotel_name',
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




}
