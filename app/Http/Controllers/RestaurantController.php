<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Models\Location;
use App\Models\Restaurant;
use App\Models\Category;
use App\Services\ImageService;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::all();

        return view('admin.Dynamic.restaurant', compact('locations'));
    }

    public function fetch(){
        $restaurants= Restaurant::with('location')->get();

        return response()->json(compact('restaurants'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorRestaurantRequest $request)
    {
        $validated = $request->validated();

        $imageName = (new ImageService)->uploadImage('Restaurant', $request->file('image'));
        $validated['image'] = $imageName;

        Restaurant::create($validated);

        return response()->json(['message' => '  Restaurant Added Successfully']);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        return response()->json(compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {
        //Validated request form
        $validated = $request->validated();
        //Check if the admin Did change the image
        if ($request->hasFile('image')) {
            //Delete The old image
            (new ImageService)->deleteImage('Restaurant', $restaurant->image);
            //Upload New Image
            $imageName = (new ImageService)->uploadImage('Restaurant', $request->file('image'));
            $validated['image'] = $imageName;
        }

        $restaurant->update($validated);

        return response()->json(['message' => 'Restaurant Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        (new ImageService)->deleteImage('Restaurant', $restaurant->image);

        $restaurant->delete();

        return response()->json(['message' => 'Restaurant Deleted Successfully']);
    }
}
