<?php

namespace App\Services;

use App\Models\Tour;
use App\Models\DayActivity;
use App\Models\TourDay;


class UserPlanService
{
    public function processTourDetails($tourDetails, $selectedDays, $tourName, $numberOfPeople, $authUser )
    {
        $restaurantBudget = 0;
        $budget = 0;
        $newTour = $this->createTour($selectedDays, $tourName,  $authUser->id );
         
        foreach ($tourDetails as $dayIndex => $dayData) {
            $tourDay =  TourDay::create([
                'tour_id' => $newTour->id,
                'day_number' => $dayIndex + 1,
            ]);
            foreach ($dayData as   $singleDayActivity) {
                $referableType = null;
                $activity_type = null;
                if (isset($singleDayActivity['restaurant_name'])) {
                    $referableType = \App\Models\Restaurant::class;
                    $activity_type = 'Culinary';
                } elseif (isset($singleDayActivity['site_name'])) {
                    $referableType = \App\Models\HistoricalSite::class;
                    $activity_type = 'Historical Site';
                } elseif (isset($singleDayActivity['activity_name'])) {
                    $referableType = \App\Models\Activity::class;
                    $activity_type = 'Adventure';
                }
                /**
                 * I need the city_id to set it in the tour if it's not set
                 * So I need to get the city_id from the referable model (Restaurant, HistoricalSite, Activity, etc.. )
                 * */
                $referableModel = $referableType::find($singleDayActivity['id']);
                if ($referableModel && $referableModel->location) {
                    $city_id = $referableModel->location->city_id;
                }
                if (isset($singleDayActivity['max_price']) && isset($singleDayActivity['min_price'])) {
                    $budget += ($singleDayActivity['max_price'] + $singleDayActivity['min_price']) / 2;
                } elseif (isset($singleDayActivity['entry_fees'])) {
                    $budget += $singleDayActivity['entry_fees'];
                }
                else{
                    $budget +=$singleDayActivity['price'];
                }
                DayActivity::create([
                    'tour_day_id' => $tourDay->id,
                    'activity_type' => $activity_type,
                    'referable_id' => $singleDayActivity['id'], // Set referable_id here
                    'referable_type' => $referableType, // Set referable_type here
                ]);

              
            }
        }
          // Set the city_id in the tour if it's not set
          if ($city_id && !$newTour->city_id) {
            $newTour->city_id = $city_id;
            $newTour->budget = $budget;
            $newTour->save();
        }
        return [
            'newTour' => $newTour,
        ];
    }

    private function createTour($selectedDays, $tourName,  $userId, $budget = 0.0, $rating = 0.0 )
    {
         
    
        $newTour = Tour::create([
            'start_date' => new \DateTime($selectedDays[0]),
            'end_date' => new \DateTime($selectedDays[count($selectedDays) - 1]),
            'created_by' => 'user',
            'tour_name' => $tourName,
            'budget' => $budget,
            'rating' => $rating,
          
            'number_of_people' => null,
            'user_id' => $userId,
        ]);

        return $newTour;
    }

    private function createTourDay($newTour, $dayIndex)
    {
        $newTourDay = TourDay::create([
            'tour_id' => $newTour->id,
            'day_number' => $dayIndex + 1,
        ]);

        return $newTourDay;
    }
}
