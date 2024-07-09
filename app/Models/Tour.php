<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'city_id',
        'tour_name',
        'description',
        'image',
        'budget',
        'start_date',
        'end_date',
        'rating',
        'number_of_people',
        'created_by',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'tour_reservations', 'tour_id', 'reservation_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tourDays()
    {
        return $this->hasMany(TourDay::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
