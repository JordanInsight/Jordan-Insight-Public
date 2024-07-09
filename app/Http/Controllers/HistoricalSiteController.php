<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHistoricalSiteRequest;
use App\Http\Requests\UpdateHistoricalSiteRequest;
use App\Models\Category;
use App\Models\HistoricalSite;
use App\Models\Location;
use App\Services\ImageService;


class HistoricalSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::all();
        return view('admin.Dynamic.historicalSite', compact('locations',));
    }

    public function fetch()
    {

        $historicalSites = HistoricalSite::with('location',)->get();
        return response()->json(compact('historicalSites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHistoricalSiteRequest $request)
    {
        $validated = $request->validated();

        $imageName = (new ImageService)->uploadImage('HistoricalSite', $request->file('image'));
        $validated['image'] = $imageName;

        HistoricalSite::create($validated);

        return response()->json(['message' => 'Site Added Successfully']);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HistoricalSite $historicalSite)
    {
        return response()->json(compact('historicalSite'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHistoricalSiteRequest $request, HistoricalSite $historicalSite)
    {
        //Validated request form
        $validated = $request->validated();
        //Check if the admin Did change the image
        if ($request->hasFile('image')) {
            //Delete The old image
            (new ImageService)->deleteImage('Restaurant', $historicalSite->image);
            //Upload New Image
            $imageName = (new ImageService)->uploadImage('historicalSite', $request->file('image'));
            $validated['image'] = $imageName;
        }

        $historicalSite->update($validated);

        return response()->json(['message' => 'historicalSite Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HistoricalSite $historicalSite)
    {
        (new ImageService)->deleteImage('Restaurant', $historicalSite->image);

        $historicalSite->delete();

        return response()->json(['message' => 'historicalSite Deleted Successfully']);
    }
}