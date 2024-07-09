<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'day_number',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function dayActivities()
    {
        return $this->hasMany(DayActivity::class);
    }
    

    
}
