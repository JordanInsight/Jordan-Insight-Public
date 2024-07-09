<?php

namespace App\Http\Controllers;
 
use App\Services\UserPlanService;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserPlanController extends Controller
{

    //This function is called when the user finishes the manual tour forms and clicks the submit button
    public function createNewTour(Request $request)
    {
    
        $tourDetails = $request->input('tourDetails');
       
        $selectedDays = $request->selectedDays;
      
        $tourName = $request->tourName;
       // $numberOfPeople = $request->numberOfPeople;

        $tour = (new UserPlanService())->processTourDetails($tourDetails, $selectedDays, $tourName, null, Auth::user());

        // Redirect to the tour-details.index route with the tour data
        // return redirect()->route('tour-details.index', ['tour' => $tour['newTour'] ]);
        // Get the URL of the tour-details.index route
        $redirectUrl = route('tour-details.index', ['tour' => $tour['newTour']]);

        // Return a JSON response with the tour data and the redirect URL
        return response()->json([
            'tour' => $tour,
            'redirectUrl' => $redirectUrl,
        ]);
    }

    
}
