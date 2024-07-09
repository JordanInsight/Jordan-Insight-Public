<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHotelRequest;
use App\Http\Requests\UpdateHotelRequest;
use App\Models\Hotel;
use App\Models\Location;
use App\Models\Category;
use App\Services\ImageService;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations =Location::all();

        return view('admin.Dynamic.hotel',compact('locations'));
    }

    public function fetch(){

        $hotels =Hotel::with('location')->get();

        return response()->json(compact('hotels'));
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHotelRequest $request)
    {
        $validated=$request->validated();

        $imageName = (new ImageService)->uploadImage('Hotel', $request->file('image'));
        $validated['image'] = $imageName;

        Hotel::create($validated);

        return response()->json(['message' => 'Hotel Added Successfully']);
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hotel $hotel)
    {
        return response()->json(compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHotelRequest $request, Hotel $hotel)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // Delete the old image
            (new ImageService)->deleteImage('Hotel', $hotel->image);

            $imageName = (new ImageService)->uploadImage('Hotel', $request->file('image'));
            $validated['image'] = $imageName;
        }

        
        $hotel->update($validated);

        return response()->json(['message' => 'Hotel Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        // Delete the hotel image
        (new ImageService)->deleteImage('Hotel', $hotel->image);
       
        // Delete the hotel
        $hotel->delete();

        return response()->json(['message'=>'Hotels deleted successfully']);
    }
}
