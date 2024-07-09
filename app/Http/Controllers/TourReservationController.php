<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\TourReservationSuccess;

class TourReservationController extends Controller
{
    public function checkout(Request $request)
    {
        $tour = Tour::findOrFail($request->input('tour_id'));
        $user = auth()->user();

        $start_date = $tour->start_date;
        $end_date = $tour->end_date;
        $total_price = $tour->budget;

        // Calculate total days for the tour
        $total_days = $tour->tourDays()->count();

        return view('base.tourCheckout', [
            'tour' => $tour,
            'user' => $user,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'total_price' => $total_price,
            'total_days' => $total_days, // Pass total days to the view
        ]);
    }

    public function processPayment(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $productname = "Tour Booking - " . $request->input('tour_name');
        $totalprice = $request->input('total');
        $two0 = "00";
        $total = "$totalprice$two0";
        $total = $total*100;

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
            'success_url' => route('tour.reservation.success', [
                'tour_id' => $request->input('tour_id'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email')
            ]),
            'cancel_url' => route('tour.checkout'),
        ]);

        return redirect()->away($session->url);
    }

    public function reservationSuccess(Request $request)
    {
        $tour = Tour::findOrFail($request->input('tour_id'));

        // Save the reservation details
        $reservation = Reservation::create([
            'user_id' => auth()->id(),
            'tour_id' => $tour->id,
            'reservation_date' => Carbon::now(),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email')
        ]);

        // Prepare the reservation details array
        $reservationDetails = [
            'user_name' => auth()->user()->name,
            'tour_name' => $tour->tour_name,
            'tour_city' => $tour->city->name,
            'tour_budget' => $tour->budget,
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'total_price' => $tour->budget * Carbon::parse($request->input('end_date'))->diffInDays(Carbon::parse($request->input('start_date'))),
        ];

        // Send the reservation success email
        Mail::to(auth()->user()->email)->send(new TourReservationSuccess($reservationDetails));

        return view('base.reservationSuccess');
    }
}
