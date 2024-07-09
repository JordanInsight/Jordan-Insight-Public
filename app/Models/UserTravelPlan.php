<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTravelPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'city_id',
        'location_id',
        'selected_hotel_id',
        'selected_restaurant_id',
        'selected_activity_id',
        'days',
        'creation_date',
        'modification_date',
        'status',
    ];
}
