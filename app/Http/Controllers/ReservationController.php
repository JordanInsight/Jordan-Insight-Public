<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Mail\ReservationSuccess;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Car;
use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mail;

class ReservationController extends Controller
{
    public function index()
    {
        $users = User::all();
        $cars = Car::where('status', 1)->get(); // Fetch only available cars
        $tours = Tour::all();

        return view('admin.Dynamic.reservation', compact('users', 'cars', 'tours'));
    }

    public function fetchCarReservations()
    {
        $reservations = Reservation::with(['user', 'car'])->whereNotNull('car_id')->get();
        return response()->json(compact('reservations'));
    }

    public function fetchTourReservations()
    {
        $reservations = Reservation::with(['user', 'tour'])->whereNotNull('tour_id')->get();
        return response()->json(compact('reservations'));
    }

    public function fetchAvailableCars()
    {
        $cars = Car::where('status', 1)->get();
        return response()->json(compact('cars'));
    }

    public function store(StoreReservationRequest $request)
    {
        $validated = $request->validated();
        $validated['reservation_date'] = Carbon::now();

        // Create the reservation
        $reservation = Reservation::create($validated);

        // Update the car status if a car reservation is made
        if (isset($validated['car_id'])) {
            $car = Car::find($validated['car_id']);
            $car->status = 0; // Set status to unavailable
            $car->save();
        }

        return response()->json(['message' => 'Reservation Added Successfully']);
    }

    public function carReservation(StoreReservationRequest $request, $carId)
    {
        // Verify authentication
        if (!auth()->check()) {
            return response()->json(['message' => 'User is not authenticated.'], 401);
        }

        $validated = $request->validated();
        $validated['reservation_date'] = Carbon::now();
        $validated['car_id'] = $carId;
        $validated['user_id'] = auth()->id(); // Automatically set the authenticated user ID

        // Debug statement to check user ID
        if (!$validated['user_id']) {
            return response()->json(['message' => 'Authenticated user ID is not available.'], 400);
        }

        // Create the reservation
        $reservation = Reservation::create($validated);

        // Update the car status if a car reservation is made
        $car = Car::find($carId);
        $car->status = 0; // Set status to unavailable
        $car->save();

        return response()->json(['message' => 'Reservation Added Successfully']);
    }



    public function edit(Reservation $reservation)
    {
        return response()->json(compact('reservation'));
    }

    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $validated = $request->validated();

        // Check if the car_id has been changed
        if (isset($validated['car_id']) && $reservation->car_id != $validated['car_id']) {
            // Set the original car status to available
            $originalCar = Car::find($reservation->car_id);
            if ($originalCar) {
                $originalCar->status = 1;
                $originalCar->save();
            }
            // Set the new car status to unavailable
            $newCar = Car::find($validated['car_id']);
            if ($newCar) {
                $newCar->status = 0;
                $newCar->save();
            }
        }

        $reservation->update($validated);

        return response()->json(['message' => 'Reservation Updated Successfully']);
    }

    public function destroy(Reservation $reservation)
    {
        // Update the car status if a car reservation is deleted
        if ($reservation->car_id) {
            $car = Car::find($reservation->car_id);
            $car->status = 1; // Set status to available
            $car->save();
        }

        $reservation->delete();

        return response()->json(['message' => 'Reservation Deleted Successfully']);
    }


    public function checkout(Request $request)
    {
        $car = Car::findOrFail($request->input('car_id'));
        $user = auth()->user();

        $start_date = \Carbon\Carbon::parse($request->input('start_date'));
        $end_date = \Carbon\Carbon::parse($request->input('end_date'));
        $days = $end_date->diffInDays($start_date);
        $total_price = $days * $car->price;

        return view('base.checkout', [
            'car' => $car,
            'user' => $user,
            'start_date' => $start_date->toDateString(),
            'end_date' => $end_date->toDateString(),
            'phone' => $request->input('phone'),
            'total_price' => $total_price,
            'days' => $days,
        ]);
    }

    public function processPayment(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $productname = "Car Booking - " . $request->input('car_name');
        $totalprice = $request->input('total');
        $two0 = "00";
        $total = "$totalprice$two0";

        $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $productname,
                        ],
                        'unit_amount' => (int) $total,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('reservation.success', [
                'car_id' => $request->input('car_id'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'phone' => $request->input('phone')
            ]),
            'cancel_url' => route('checkout'),
        ]);

        return redirect()->away($session->url);
    }

    public function reservationSuccess(Request $request)
    {
        $car = Car::findOrFail($request->input('car_id'));

        // Update car status to 0
        $car->status = 0;
        $car->save();

        // Save the reservation details
        $reservation = Reservation::create([
            'user_id' => auth()->id(),
            'car_id' => $car->id,
            'reservation_date'=>Carbon::now(),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'phone' => $request->input('phone'),
        ]);

        // Send the reservation success email
        $reservationDetails = [
            'user_name' => auth()->user()->name,
            'car_name' => $car->car_name,
            'car_model' => $car->model,
            'car_price' => $car->price,
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'total_price' => $car->price * \Carbon\Carbon::parse($request->input('end_date'))->diffInDays(\Carbon\Carbon::parse($request->input('start_date'))),
        ];
        Mail::to(auth()->user()->email)->send(new ReservationSuccess($reservationDetails));

        return view('base.reservationSuccess');
    }
}
