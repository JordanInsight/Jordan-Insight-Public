<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTourRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tour_name' => 'required|string|max:255',
            'description' => 'required|string',
            'budget' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'number_of_people' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'days' => 'required|integer|min:1'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $start_date = $this->input('start_date');
            $end_date = $this->input('end_date');
            $days = $this->input('days');

            if ($start_date && $end_date && $days) {
                $start = \Carbon\Carbon::parse($start_date);
                $end = \Carbon\Carbon::parse($end_date);
                $diff = $start->diffInDays($end) + 1; // +1 to include both start and end dates

                if ($days > $diff) {
                    $validator->errors()->add('days', 'Number of days cannot be more than the difference between the start and end dates.');
                }
            }
        });
    }
}
