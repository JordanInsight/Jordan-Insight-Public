<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Hotel;
use App\Models\Tour;
use App\Models\DayActivity;
use App\Models\Location;
use App\Models\TourDay;

class TourDetailsController extends Controller
{
    public function index(Tour $tour)
    {
        $tourId = $tour->id;

        // $toursDays = TourDay::where('tour_id', $tourId)->get();

        $toursDays = TourDay::with('dayActivities')->where('tour_id', $tourId)->get();

        // Extracting all tour_day_ids from the toursDays collection
        $tourDayIds = $toursDays->pluck('id');

        // Assuming $tourDayIds is already defined and contains the IDs of the tour days you're interested in
        $daysActivities = DayActivity::whereIn('tour_day_id', $tourDayIds)->get();

        $activities = [];
        $tourId = $tour->id;

        $toursDays = TourDay::with('dayActivities')->withCount('dayActivities')->where('tour_id', $tourId)->get();

        $activities = [];
        $citiesName = [];

        foreach ($toursDays as $tourDay) {
            foreach ($tourDay->dayActivities as $activityReference) {
                $entity = resolve($activityReference->referable_type)->find($activityReference->referable_id);
                $activities[] = $entity;

                $cityName = $entity::with('location.city')->find($entity->id)->location->city->city_name;
                if (!in_array($cityName, $citiesName)) {
                    $citiesName[] = $cityName;
                }
            }
        }

        $city = $citiesName[0];

        $cityId = City::where('city_name', $city)->first()->id;

        $locationIds = Location::where('city_id', $cityId)->pluck('id');

        $hotels = Hotel::whereIn('location_id', $locationIds)
            ->orderBy('rating', 'desc')
            ->limit(4)
            ->get();

        // Fetch reviews for the tour
        $reviews = $tour->reviews()->with('user')->get();
        //dd($toursDays[0] );
        return view('base.tour-details', compact('tour', 'toursDays', 'daysActivities', 'activities', 'citiesName', 'hotels', 'reviews'));
    }
}
