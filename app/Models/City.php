<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'city_name',
    ];

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }
    
}
