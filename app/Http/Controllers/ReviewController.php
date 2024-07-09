<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review; // Assuming you have a Review model
use App\Models\Tour;

class ReviewController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
      
    }

    // Show the form for creating a new resource.
    public function create()
    {
      ;
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'rating' => 'required|integer|between:1,5',
            'content' => 'required|string',
        ]);
    
        // Ensure the rating is within the allowed range
        $rating = max(1, min(5, $request->rating));
    
        // Create the new review
        Review::create([
            'user_id' => auth()->user()->id,
            'tour_id' => $request->tour_id,
            'rating' => $rating,
            'content' => $request->content, // Assuming 'content' is the field name in the form
        ]);
    
        // Retrieve the tour
        $tour = Tour::find($request->tour_id);
    
        // Recalculate the average rating for the tour including the new review
        $newAverageRating = $tour->reviews()->avg('rating');
        $tour->rating = $newAverageRating;
    
        // Save the updated tour
        $tour->save();
        
    
    }

    // Display the specified resource.
    public function show($id)
    {
      
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
       
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
       
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        
    }
}
