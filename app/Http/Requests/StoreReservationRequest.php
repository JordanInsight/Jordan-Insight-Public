<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'car_id' => 'nullable|exists:cars,id|required_if:reservation_type,car',
            'tour_id' => 'nullable|exists:tours,id|required_if:reservation_type,tour',
            'reservation_date' => 'nullable|date',
            'start_date' => 'required|date|after_or_equal:reservation_date',
            'end_date' => 'required|date|after:start_date',
            'phone' => 'required|string|max:15',
        ];
    }
}
