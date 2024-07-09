<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_name',
        'model',
        'type',
        'image',
        'number_of_seats',
        'status',
        'price',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function isAvailable()
    {
        return $this->status;
    }

    public function markAsBooked()
    {
        $this->status = false;
        $this->save();
    }

    public function markAsAvailable()
    {
        $this->status = true;
        $this->save();
    }
}

