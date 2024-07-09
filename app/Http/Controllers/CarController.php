<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;
use App\Models\Reservation;
use App\Services\ImageService;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();
        return view('admin.Dynamic.car', compact('reservations'));
    }
    public function vendorIndex()
    {
        $reservations = Reservation::all();
        return view('vendor.Dynamic.car', compact('reservations'));
    }

    public function fetch()
    {
        $cars = Car::with('reservations')->get();
        return response()->json(compact('cars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request)
    {
        $validated = $request->validated();

        $imageName = (new ImageService)->uploadImage('Car', $request->file('image'));
        $validated['image'] = $imageName;
        $validated['price'] = $request->price;

        Car::create($validated);

        return response()->json(['message' => 'Car Added Successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return response()->json(compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            // Delete the old image
            (new ImageService)->deleteImage('Car', $car->image);

            $imageName = (new ImageService)->uploadImage('Car', $request->file('image'));
            $validated['image'] = $imageName;
        }

        $validated['price'] = $request->price;

        $car->update($validated);

        return response()->json(['message' => 'Car Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        // Delete the car image
        (new ImageService)->deleteImage('Car', $car->image);

        // Delete the car
        $car->delete();

        return response()->json(['message' => 'Car deleted successfully']);
    }
}
