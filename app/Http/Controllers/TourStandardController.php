<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\City;
use Carbon\Carbon;

class TourStandardController extends Controller
{

    public function index(Request $request)
    {
        $cities = City::all();
        $categories = Category::all();
        $minPrice = 0;
        $maxPrice = Tour::max('budget');

        return view('base.tour-standard', compact('cities', 'categories', 'minPrice', 'maxPrice'));
    }

    public function fetch(Request $request)
    {
        $query = Tour::with(['city', 'tourDays.dayActivities.activityCategory']);

        // Apply sorting
        if ($request->filled('sort_by')) {
            switch ($request->input('sort_by')) {
                case 'By Reviews':
                    $query->orderBy('rating', 'desc');
                    break;
                case 'By Price':
                    $query->orderBy('budget', 'asc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        }

        // Apply price filter if both min and max prices are provided
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $minPrice = (float) $request->input('min_price');
            $maxPrice = (float) $request->input('max_price');
            $query->whereBetween('budget', [$minPrice, $maxPrice]);
        }

        // Apply city filter if provided
        if ($request->filled('cities')) {
            $cities = explode(',', $request->input('cities'));
            if (!empty($cities)) {
                $query->whereIn('city_id', $cities);
            }
        }

        // Apply category filter if provided
        if ($request->filled('categories')) {
            $categories = explode(',', $request->input('categories'));
            if (!empty($categories)) {
                $query->whereHas('tourDays.dayActivities', function ($q) use ($categories) {
                    $q->whereIn('activity_type', $categories);
                });
            }
        }

        // Apply rating filter if provided
        if ($request->filled('ratings')) {
            $ratings = explode(',', $request->input('ratings'));
            if (!empty($ratings)) {
                $query->whereIn('rating', $ratings);
            }
        }

        // Fetch tours created by Admin or Vendor
        $query->whereIn('created_by', ['Admin', 'Vendor']);

        // Fetch the tours based on the filters applied and paginate
        $tours = $query->paginate(6);

        foreach ($tours as $tour) {
            $totalNumberOfDays = $tour->tourDays->unique('day_number')->count();
            $tour->total_number_of_days = $totalNumberOfDays;
            $tour->categories = $tour->tourDays->flatMap(function ($tourDay) {
                return $tourDay->dayActivities->map(function ($activity) {
                    return $activity->activityCategory->category_name;
                });
            })->unique()->values();
        }

        return response()->json($tours);
    }

    public function searchFetch(Request $request)
    {
        $query = Tour::with(['city', 'tourDays.dayActivities.activityCategory']);

        // Apply sorting
        if ($request->filled('sort_by')) {
            switch ($request->input('sort_by')) {
                case 'By Reviews':
                    $query->orderBy('rating', 'desc');
                    break;
                case 'By Price':
                    $query->orderBy('budget', 'asc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        }

        // Apply price filter if both min and max prices are provided
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $minPrice = (float) $request->input('min_price');
            $maxPrice = (float) $request->input('max_price');
            $query->whereBetween('budget', [$minPrice, $maxPrice]);
        }

        // Apply city filter if provided
        if ($request->filled('cities')) {
            $cities = explode(',', $request->input('cities'));
            if (!empty($cities)) {
                $query->whereIn('city_id', $cities);
            }
        }

        // Apply category filter if provided
        if ($request->filled('categories')) {
            $categories = explode(',', $request->input('categories'));
            if (!empty($categories)) {
                $query->whereHas('tourDays.dayActivities', function ($q) use ($categories) {
                    $q->whereIn('activity_type', $categories);
                });
            }
        }

        // Apply rating filter if provided
        if ($request->filled('ratings')) {
            $ratings = explode(',', $request->input('ratings'));
            if (!empty($ratings)) {
                $query->whereIn('rating', $ratings);
            }
        }

        // Apply search filters if provided
        if ($request->filled('place')) {
            $query->whereHas('city', function ($q) use ($request) {
                $q->where('city_name', 'like', '%' . $request->input('place') . '%');
            });
        }

        if ($request->filled('when')) {
            $query->where('start_date', $request->input('when'));
        }

        if ($request->filled('type')) {
            $query->whereHas('tourDays.dayActivities', function ($q) use ($request) {
                $q->where('activity_type', $request->input('type'));
            });
        }

        // Fetch tours created by Admin or Vendor
        $query->whereIn('created_by', ['Admin', 'Vendor']);

        // Fetch the tours based on the filters applied and paginate
        $tours = $query->paginate(6);

        foreach ($tours as $tour) {
            $totalNumberOfDays = $tour->tourDays->unique('day_number')->count();
            $tour->total_number_of_days = $totalNumberOfDays;
            $tour->categories = $tour->tourDays->flatMap(function ($tourDay) {
                return $tourDay->dayActivities->map(function ($activity) {
                    return $activity->activityCategory->category_name;
                });
            })->unique()->values();
        }

        return response()->json($tours);
    }
}
