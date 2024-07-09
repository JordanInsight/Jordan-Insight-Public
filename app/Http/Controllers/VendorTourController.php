<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTourRequest;
use App\Http\Requests\UpdateTourRequest;
use App\Models\Tour;
use App\Models\TourDay;
use App\Models\DayActivity;
use App\Models\Category;
use App\Models\Activity;
use App\Models\HistoricalSite;
use App\Models\Restaurant;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VendorTourController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('vendor.Dynamic.tour', compact('categories'));
    }

    public function fetchTours()
    {
        $tours = Tour::with('tourDays.dayActivities')
            ->where('created_by', 'Vendor')
            ->get();
        return response()->json(compact('tours'));
    }


    public function store(StoreTourRequest $request)
    {
        DB::transaction(function () use ($request) {
            $user = Auth::user();
            $roleName = $user->role->role_name;

            $tourData = $request->only(['tour_name', 'description', 'budget', 'start_date', 'end_date', 'number_of_people']);
            $tourData['created_by'] = $roleName;
            $tourData['user_id'] = $user->id;

            if ($request->hasFile('image')) {
                $imageName = (new ImageService)->uploadImage('Tour', $request->file('image'));
                $tourData['image'] = $imageName;
            }

            $activityType = $request->input('activity_type_1')[0];
            $referableId = $request->input('referable_id_1')[0];
            $cityId = $this->getCityIdByActivityTypeAndId($activityType, $referableId);

            $tourData['city_id'] = $cityId;
            $tour = Tour::create($tourData);

            $numberOfDays = $request->input('days');
            for ($i = 1; $i <= $numberOfDays; $i++) {
                $tourDay = TourDay::create(['tour_id' => $tour->id, 'day_number' => $i]);

                $activityTypes = $request->input('activity_type_' . $i);
                $referableIds = $request->input('referable_id_' . $i);
                $additionalDetails = $request->input('additional_details_' . $i);
                $referableTypes = $request->input('referable_type_' . $i);

                for ($j = 0; $j < count($activityTypes); $j++) {
                    DayActivity::create([
                        'tour_day_id' => $tourDay->id,
                        'activity_type' => $activityTypes[$j],
                        'additional_details' => $additionalDetails[$j],
                        'referable_id' => $referableIds[$j],
                        'referable_type' => $referableTypes[$j],
                    ]);
                }
            }
        });

        return response()->json(['message' => 'Tour Added Successfully']);
    }

    public function show(Tour $tour)
    {
        $tour->load('tourDays.dayActivities.referable', 'tourDays.dayActivities.activityCategory');
        return response()->json($tour);
    }



    public function edit(Tour $tour)
    {
        $tour->load('tourDays.dayActivities');
        return response()->json($tour);
    }

    public function update(UpdateTourRequest $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $tour = Tour::findOrFail($id);
            $tourData = $request->validated();

            $activityType = $request->input('days')[0]['activities'][0]['activity_type'];
            $referableId = $request->input('days')[0]['activities'][0]['referable_id'];
            $cityId = $this->getCityIdByActivityTypeAndId($activityType, $referableId);

            $tourData['city_id'] = $cityId;
            $tour->update($tourData);

            // Get existing days and activities
            $existingDays = $tour->tourDays->pluck('id')->toArray();
            $existingActivities = DayActivity::whereIn('tour_day_id', $existingDays)->pluck('id')->toArray();

            // Process days and activities
            $days = $request->input('days');
            $newDays = [];
            $newActivities = [];

            foreach ($days as $day) {
                if (isset($day['id']) && !empty($day['id'])) {
                    $tourDay = TourDay::findOrFail($day['id']);
                    $tourDay->update([
                        'day_number' => $day['day_number']
                    ]);
                } else {
                    $tourDay = TourDay::create([
                        'tour_id' => $tour->id,
                        'day_number' => $day['day_number']
                    ]);
                }

                $newDays[] = $tourDay->id;

                foreach ($day['activities'] as $activity) {
                    if (isset($activity['id']) && !empty($activity['id'])) {
                        $dayActivity = DayActivity::findOrFail($activity['id']);
                        $dayActivity->update([
                            'activity_type' => $activity['activity_type'],
                            'additional_details' => $activity['additional_details'],
                            'referable_id' => $activity['referable_id'],
                            'referable_type' => $activity['referable_type']
                        ]);
                    } else {
                        $dayActivity = DayActivity::create([
                            'tour_day_id' => $tourDay->id,
                            'activity_type' => $activity['activity_type'],
                            'additional_details' => $activity['additional_details'],
                            'referable_id' => $activity['referable_id'],
                            'referable_type' => $activity['referable_type']
                        ]);
                    }
                    $newActivities[] = $dayActivity->id;
                }
            }

            // Delete removed days and activities
            $daysToDelete = array_diff($existingDays, $newDays);
            DayActivity::whereIn('tour_day_id', $daysToDelete)->delete();
            TourDay::whereIn('id', $daysToDelete)->delete();

            $activitiesToDelete = array_diff($existingActivities, $newActivities);
            DayActivity::whereIn('id', $activitiesToDelete)->delete();
        });

        return response()->json(['message' => 'Tour updated successfully.']);
    }


    private function getCityIdByActivityTypeAndId($activityType, $referableId)
    {
        if ($activityType == 1) {
            return Activity::find($referableId)->location->city_id;
        } elseif ($activityType == 2) {
            return HistoricalSite::find($referableId)->location->city_id;
        } elseif ($activityType == 3) {
            return Restaurant::find($referableId)->location->city_id;
        }
        return null;
    }

    public function destroy(Tour $tour)
    {
        DB::transaction(function () use ($tour) {
            foreach ($tour->tourDays as $day) {
                $day->dayActivities()->delete();
            }
            $tour->tourDays()->delete();
            (new ImageService)->deleteImage('Tour', $tour->image);
            $tour->delete();
        });

        return response()->json(['message' => 'Tour Deleted Successfully']);
    }

    public function fetchActivities()
    {
        $activities = Activity::all();
        return response()->json(compact('activities'));
    }

    public function fetchHistoricalSites()
    {
        $historicalSites = HistoricalSite::all();
        return response()->json(compact('historicalSites'));
    }

    public function fetchRestaurants()
    {
        $restaurants = Restaurant::all();
        return response()->json(compact('restaurants'));
    }
}
