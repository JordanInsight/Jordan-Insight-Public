<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Restaurant;
use App\Models\Category;
use App\Models\City;
use App\Models\HistoricalSite;
use App\Services\UserPlanQueryService;
use Illuminate\Http\Request;

class UserPlanFetchController extends Controller
{
    public function index(Request $request)
    {
        //  Get the days parameter from the request
        $numberOfDays = $request->numberOfDays;
        // Get the selected days as a comma-separated string from the request

        $selectedDates = $request->selectedDates;
      
        $city= $request->city;
       
        $city = City::where('city_name', $request->city)->first();
      
        $monthName = $request->monthName;

        // Retrieve other necessary data from your database or elsewhere
        $categories = Category::all();
     

        $tourName= $request->tourName;
       // $numberOfPeople= $request->numberOfPeople;
     
      return view('base.userPlan', compact('categories',  'numberOfDays', 'selectedDates', 'monthName','tourName','city'));
    }


    public function showRestaurants(Request $request)
    {
        $restaurants = (new UserPlanQueryService)
            ->getEntitiesByLocation($request, Restaurant::class);

        return response()->json(compact('restaurants'));
    }

    public function showActivities(Request $request)
    {
        $activities = (new UserPlanQueryService)
            ->getEntitiesByLocation($request, Activity::class);

        return response()->json(compact('activities'));
    }
    public function showHistoricalSites(Request $request)
    {
        $sites = (new UserPlanQueryService)
            ->getEntitiesByLocation($request, HistoricalSite::class);

        return response()->json(compact('sites'));
    }

    public function showRestaurantsByCuisine(Request $request)
    {
        $restaurant_id = $request->restaurant_id;
        $restaurant = Restaurant::find($restaurant_id);
        $cuisine = $restaurant->cuisine;
        $restaurants = Restaurant::where('cuisine', $cuisine)->get();

        return response()->json(compact('restaurants'));
    }


    public function showEntitiesByCategory(Category $category)
    {
        try {
            if ($category->category_name == 'Food') {
                return $this->getRestaurants();
            } else {
                return $this->getHistoricalSites();
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function getRestaurants()
    {
        $restaurants = Restaurant::all()->groupBy('cuisine');
        return response()->json(compact('restaurants'));
    }

    private function getHistoricalSites()
    {
        $sites = HistoricalSite::all();
        return response()->json(compact('sites'));
    }


    public function showCuisine(Request $request)
    {
        $restaurantIds = explode(',', $request->restaurant_ids);
        $restaurantsByCuisines = (new UserPlanQueryService)->getRestaurantsByCuisines($restaurantIds);

        return response()->json(compact('restaurantsByCuisines'));
    }
}
