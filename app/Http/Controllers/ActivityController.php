<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Services\ImageService;

class ActivityController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $locations = Location::all();
        $categories = Category::all();

        return view('admin.Dynamic.activity', compact('locations', 'categories'));
    }




    public function fetch()
    {
        $activities = Activity::with(['location'])->get();
        return response()->json(compact('activities'));
    }


    public function store(StoreActivityRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $imageName = $this->imageService->uploadImage('activities', $request->file('image'));
            $validated['image'] = $imageName;
        }

        Activity::create($validated);

        return response()->json(['message' => 'Activity Added Successfully']);
    }

    public function edit(Activity $activity)
    {
        return response()->json(compact('activity'));
    }

    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // Delete the old image
            $this->imageService->deleteImage('activities', $activity->image);

            $imageName = $this->imageService->uploadImage('activities', $request->file('image'));
            $validated['image'] = $imageName;
        }

        $activity->update($validated);

        return response()->json(['message' => 'Activity Updated Successfully']);
    }

    public function destroy(Activity $activity)
    {
        if ($activity->image) {
            $this->imageService->deleteImage('activities', $activity->image);
        }

        $activity->delete();

        return response()->json(['message' => 'Activity Deleted Successfully']);
    }
}
