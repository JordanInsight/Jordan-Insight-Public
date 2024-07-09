<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\City;
use App\Models\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities =City::all();
        return view('admin.Dynamic.location', compact('cities'));
    }
   
    /**
     * Display a listing of the resource
     */
    public function fetch()
    {
        $locations = Location::with('city')->get();
        return response()->json(['locations' => $locations]);
    }

    

    /** 
     * Store new record to the table
     */
    public function store(StoreLocationRequest $request)
    {
        $validated= $request->validated();

        $location = Location::create($validated);

        return response()->json([
            'message' => 'location created successfully',
            'location' => $location
        ]);
    }

  

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(location $location)
    {
        return response()->json(['location' => $location]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationRequest $request,location $location)
    {
        
        $validated = $request->validated();

       $location->update($validated);

        return response()->json([
            'message' => 'location updated successfully',
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $id = $location->id;
        $location->delete();
        return response()->json(['tr' => 'tr_' . $id ,'message'=>'location deleted successfully']);
    }

     
}
