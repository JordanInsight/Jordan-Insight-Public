<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Car;
use App\Models\City;
use App\Models\Hotel;
use App\Models\Category;
use App\Models\HistoricalSite;
use App\Models\Post;
use App\Models\Restaurant;
use App\Models\Review;
use App\Models\Tour;

use Illuminate\Http\Request;

class MainController extends Controller
{
    //

    public function index()
    {
        $cities = City::take(2)->get();
        $Categories = Category::all();
        $posts = Post::with('user')
            ->withCount(['comments', 'likes'])
            ->latest('updated_at')
            ->paginate(3);

        $tours = Tour::with(['city', 'tourDays.dayActivities.activityCategory'])
            ->withCount('tourDays') // This will add the tourDays_count column
            ->orderBy('rating', 'desc')
            ->inRandomOrder()
            ->take(4)
            ->get();

        $reviews = Review::with('user', 'tour')->get();


        return view('base.index', compact('cities', 'Categories', 'posts', 'tours', 'reviews'));
    }


    public function contact()
    {
        return view('base.contact');
    }
    public function about()
    {
        return view('base.about');
    }
    public function tourSidebar()
    {
        return view('base.tour-sidebar');
    }

    public function destinations()
    {

        return  view('base.destinations');
    }
    public function destinationsAmman()
    {
        return  view('base.destinationsAmman');
    }
    public function destinationsDeadsea()
    {
        return  view('base.destinationsDeadsea');
    }
    public function destinationsPetra()
    {
        return  view('base.destinationsPetra');
    }
    public function destinationsAjloun()
    {
        return  view('base.destinationsAjloun');
    }
    public function destinationsAqaba()
    {
        return  view('base.destinationsAqaba');
    }
    public function destinationsJerash()
    {
        return  view('base.destinationsJerash');
    }
    public function destinationsMadaba()
    {
        return  view('base.destinationsMadaba');
    }
    public function destinationsWadirum()
    {
        return  view('base.destinationsWadirum');
    }
    public function destinationsZarqa()
    {
        return  view('base.destinationsZarqa');
    }

    public function pageHotel(Request $request)
    {
        $hotels = Hotel::all();
        $cities = City::all(); // Assuming you have a City model
        $hotels_count = $hotels->count();
        // Get min and max prices
        $minPrice = Hotel::min('min_price');
        $maxPrice = Hotel::max('max_price');

        return view('base.Hotel', compact('hotels', 'hotels_count', 'minPrice', 'maxPrice', 'cities'));
    }


    public function pageHotelFetch(Request $request)
    {
        $query = Hotel::with('location.city');

        // Apply sorting
        if ($request->filled('sort_by')) {
            switch ($request->input('sort_by')) {
                case 'By Reviews':
                    $query->orderBy('rating', 'desc');
                    break;
                case 'By Price':
                    $query->orderByRaw('(min_price + max_price) / 2 asc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        }


        // Apply price filter if both min and max prices are provided
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $minPrice = (float) $request->input('min_price');
            $maxPrice = (float) $request->input('max_price');
            $query->whereRaw('((min_price + max_price) / 2) BETWEEN ? AND ?', [$minPrice, $maxPrice]);
        }

        // Apply ratings filter if provided
        if ($request->filled('ratings')) {
            $ratings = explode(',', $request->input('ratings'));
            if (!empty($ratings)) {
                $query->whereIn('rating', $ratings);
            }
        }

        // Apply city filter if provided
        if ($request->filled('cities')) {
            $cities = explode(',', $request->input('cities'));
            if (!empty($cities)) {
                $query->whereHas('location.city', function ($q) use ($cities) {
                    $q->whereIn('city_name', $cities);
                });
            }
        }

        // Fetch the hotels based on the filters applied and paginate
        $hotels = $query->paginate(6);

        return response()->json($hotels);
    }

    public function pageHistoricalSite(Request $request)
    {
        $sites = HistoricalSite::all();
        $cities = City::all();
        $sites_count = $sites->count();
        $minPrice = HistoricalSite::min('entry_fees');
        $maxPrice = HistoricalSite::max('entry_fees');

        return view('base.HistoricalSite', compact('sites', 'sites_count', 'minPrice', 'maxPrice', 'cities'));
    }

    public function pageHistoricalSiteFetch(Request $request)
    {
        $query = HistoricalSite::with('location.city');

        if ($request->filled('sort_by')) {
            switch ($request->input('sort_by')) {
                case 'By Reviews':
                    $query->orderBy('rating', 'desc');
                    break;
                case 'By Entry Fees':
                    $query->orderBy('entry_fees', 'asc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        }

        if ($request->filled('min_price') && $request->filled('max_price')) {
            $minPrice = (float) $request->input('min_price');
            $maxPrice = (float) $request->input('max_price');
            $query->whereBetween('entry_fees', [$minPrice, $maxPrice]);
        }

        if ($request->filled('ratings')) {
            $ratings = explode(',', $request->input('ratings'));
            if (!empty($ratings)) {
                $query->whereIn('rating', $ratings);
            }
        }

        if ($request->filled('cities')) {
            $cities = explode(',', $request->input('cities'));
            if (!empty($cities)) {
                $query->whereHas('location.city', function ($q) use ($cities) {
                    $q->whereIn('city_name', $cities);
                });
            }
        }

        $sites = $query->paginate(6);

        return response()->json($sites);
    }


    public function pageRestaurant(Request $request)
    {
        $restaurants = Restaurant::all();
        $cities = City::all(); // Assuming you have a City model
        $restaurants_count = $restaurants->count();
        // Get min and max prices
        $minPrice = Restaurant::min('min_price');
        $maxPrice = Restaurant::max('max_price');

        return view('base.Restaurant', compact('restaurants', 'restaurants_count', 'minPrice', 'maxPrice', 'cities'));
    }

    public function pageRestaurantFetch(Request $request)
    {
        $query = Restaurant::with('location.city');

        // Apply sorting
        if ($request->filled('sort_by')) {
            switch ($request->input('sort_by')) {
                case 'By Reviews':
                    $query->orderBy('rating', 'desc');
                    break;
                case 'By Price':
                    $query->orderByRaw('(min_price + max_price) / 2 asc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        }

        // Apply price filter if both min and max prices are provided
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $minPrice = (float) $request->input('min_price');
            $maxPrice = (float) $request->input('max_price');
            $query->whereRaw('((min_price + max_price) / 2) BETWEEN ? AND ?', [$minPrice, $maxPrice]);
        }

        // Apply ratings filter if provided
        if ($request->filled('ratings')) {
            $ratings = explode(',', $request->input('ratings'));
            if (!empty($ratings)) {
                $query->whereIn('rating', $ratings);
            }
        }

        // Apply city filter if provided
        if ($request->filled('cities')) {
            $cities = explode(',', $request->input('cities'));
            if (!empty($cities)) {
                $query->whereHas('location.city', function ($q) use ($cities) {
                    $q->whereIn('city_name', $cities);
                });
            }
        }

        // Fetch the restaurants based on the filters applied and paginate
        $restaurants = $query->paginate(6);

        return response()->json($restaurants);
    }

    public function pageActivity(Request $request)
    {
        $activities = Activity::all();
        $cities = City::all(); // Assuming you have a City model
        $activities_count = $activities->count();
        // Get the price range
        $maxPrice = Activity::max('price');

        return view('base.Activity', compact('activities', 'activities_count', 'maxPrice', 'cities'));
    }

    public function pageActivityFetch(Request $request)
    {
        $query = Activity::with('location.city');

        // Apply sorting
        if ($request->filled('sort_by')) {
            switch ($request->input('sort_by')) {
                case 'By Reviews':
                    $query->orderBy('rating', 'desc');
                    break;
                case 'By Price':
                    $query->orderBy('price', 'asc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        }

        // Apply price filter if provided
        if ($request->filled('price')) {
            $price = (float) $request->input('price');
            $query->where('price', '<=', $price);
        }

        // Apply ratings filter if provided
        if ($request->filled('ratings')) {
            $ratings = explode(',', $request->input('ratings'));
            if (!empty($ratings)) {
                $query->whereIn('rating', $ratings);
            }
        }

        // Apply city filter if provided
        if ($request->filled('cities')) {
            $cities = explode(',', $request->input('cities'));
            if (!empty($cities)) {
                $query->whereHas('location.city', function ($q) use ($cities) {
                    $q->whereIn('city_name', $cities);
                });
            }
        }

        // Fetch the activities based on the filters applied and paginate
        $activities = $query->paginate(6);

        return response()->json($activities);
    }

    public function pageCar(Request $request)
    {
        $cars = Car::all();
        $models = Car::distinct()->pluck('model'); // Assuming model is a column in your cars table
        $seats = Car::distinct()->pluck('number_of_seats'); // Assuming number_of_seats is a column in your cars table
        $maxPrice = Car::max('price');

        return view('base.Car', compact('cars', 'models', 'seats', 'maxPrice'));
    }
    public function pageCarFetch(Request $request)
    {
        $query = Car::where('status', 1); // Only fetch cars where status is 1

        // Apply sorting
        if ($request->filled('sort_by')) {
            switch ($request->input('sort_by')) {
                case 'By Price':
                    $query->orderBy('price', 'asc');
                    break;
                case 'By Model':
                    $query->orderBy('model', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        }

        // Apply price filter if provided
        if ($request->filled('price')) {
            $price = (float) $request->input('price');
            $query->where('price', '<=', $price);
        }

        // Apply model filter if provided
        if ($request->filled('models')) {
            $models = explode(',', $request->input('models'));
            if (!empty($models)) {
                $query->whereIn('model', $models);
            }
        }

        // Apply seats filter if provided
        if ($request->filled('seats')) {
            $seats = explode(',', $request->input('seats'));
            if (!empty($seats)) {
                $query->whereIn('number_of_seats', $seats);
            }
        }

        // Fetch the cars based on the filters applied and paginate
        $cars = $query->paginate(5);

        return response()->json($cars);
    }

    public function pageTour(Request $request)
    {
        //   $tours = Tour::all();

        // $tours_count = $tours->count();
        // Get min and max budgets
        // $minBudget = Tour::min('budget');
        // $maxBudget = Tour::max('budget');
        $categories = Category::all();
        $cities = City::all();
        $categories = Category::all();
        $minPrice = 0;

        $maxPrice = Tour::max('budget') ?? 1.0;

        return view('base.tour-sidebar', compact('minPrice', 'maxPrice', 'cities', 'categories'));
    }

    public function pageTourFetch(Request $request)
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

        // Fetch tours created by users with the role 'user'
        $query->where('created_by', 'user');

        // Add withCount to get the total number of days
        $query->withCount('tourDays');

        // Fetch the tours based on the filters applied and paginate
        $tours = $query->paginate(6);

        foreach ($tours as $tour) {
            $tour->total_number_of_days = $tour->tour_days_count; // Use the count from withCount

            $tour->categories = $tour->tourDays->flatMap(function ($tourDay) {
                return $tourDay->dayActivities->map(function ($activity) {
                    return $activity->activity_type;
                });
            })->unique()->values();
        }

        return response()->json($tours);
    }
}
