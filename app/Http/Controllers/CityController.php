<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.Dynamic.city');
    }

    /**
     * Fetch all the rows for ajax request and return it as a json 
     * */  
    public function fetch()
    {
        $cities = City::all();
        return response()->json(['cities' => $cities]);
    }
    public function search(Request $request)
    {
        //dd($request->query);
        $query = $request->input('query');
        $cities = City::where('city_name', 'LIKE', '%' . $query . '%')->get(['id', 'city_name']);
        return response()->json($cities);
    }

  

    /** 
     * Store new record in the table
     */
    public function store(StoreCityRequest $request)
    {
        //Make the validation request on the Request file in rules function 
        $validated= $request->validated();

        $city = City::create($validated);    

        return response()->json([
            'message' => 'City created successfully',
            'city' => $city,
        ]);
    }

  

    /**
     * Show the model for editing the specified resource.
     */
    public function edit(City $city)
    {
        return response()->json(['city' => $city]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCityRequest $request,City $city)
    {
        //Make the validation request on the UpdateCityRequest file in rules function 
        $validated = $request->validated();

        $city->update($validated);

        return response()->json([
            'message' => 'City updated successfully',
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $id = $city->id;
        $city->delete();
        return response()->json([ 'tr' => 'tr_' . $id ,'message'=>'City deleted successfully']);
    }

     
}
