<?php

namespace App\Services;


use App\Models\Hotel;
use App\Models\Restaurant;
use Illuminate\Support\Collection;

class UserPlanQueryService
{
    public function getEntitiesByLocation($request, $modelClass)
    {
        $city_id = $request->city_id;
        
        return $modelClass::whereHas('location', function ($query) use ($city_id) {
            $query->where('city_id', $city_id);
        })->get();
    }

    public function getRestaurantsByCuisines(array $restaurantIds): Collection
    {
        // Delegate fetching restaurants by ID to a separate method
        $restaurants = $this->getRestaurantsById($restaurantIds);

        // Extract unique cuisines from fetched restaurants
        $cuisines = $restaurants->pluck('cuisine')->unique();

        // Delegate fetching restaurants by cuisine to a separate method
        return $this->getRestaurantsByUniqueCuisines($cuisines);
    }

    private function getRestaurantsById(array $restaurantIds): Collection
    {
        // Fetch restaurants by ID 
        return Restaurant::whereIn('id', $restaurantIds)->get();
    }

    private function getRestaurantsByUniqueCuisines(Collection $cuisines): Collection
    {
        $restaurantsByCuisines = [];
        foreach ($cuisines as $cuisine) {
            $restaurantsByCuisines[$cuisine] = Restaurant::where('cuisine', $cuisine)->get();
        }

        return collect($restaurantsByCuisines);
    }

    private function getCityIdFromHotel($hotel_id)
    {
        // Find the Hotel with location and city information
        $hotel = Hotel::with('location.city')->find($hotel_id);

        // Extract city_id from the Hotel's location.city relationship
        return $hotel->location->city->id;
    }
}
