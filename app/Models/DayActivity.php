<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_day_id',
        'activity_type',
        'additional_details',
        'referable_id',
        'referable_type',
    ];

    public function referable()
    {
        return $this->morphTo();
    }

    public function tourDay()
    {
        return $this->belongsTo(TourDay::class);
    }

    public function activityCategory()
    {
        return $this->belongsTo(Category::class, 'activity_type');
    }
}
