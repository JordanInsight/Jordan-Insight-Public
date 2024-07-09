<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'hotel_id',
        'check_in',
        'check_out',
        'guest_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
