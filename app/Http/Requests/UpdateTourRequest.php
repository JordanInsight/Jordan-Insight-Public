<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateTourRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Set to false if you have authorization logic
    }

    protected function prepareForValidation()
    {
        $user = Auth::user();
        $this->merge([
            'created_by' => $user->role->role_name,
            'user_id' => $user->id,
        ]);

        // Decode the JSON string into an array
        $this->merge([
            'days' => json_decode($this->days, true),
        ]);
    }

    public function rules()
    {
        $startDate = $this->input('start_date');
        $endDate = $this->input('end_date');
        $maxDays = (new \DateTime($endDate))->diff(new \DateTime($startDate))->days + 1;

        return [
            'tour_name' => 'required|string|max:255',
            'description' => 'required|string',
            'budget' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'number_of_people' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'days' => ['required', 'array', 'max:' . $maxDays],
            'days.*.day_number' => 'required|integer',
            'days.*.activities' => 'required|array|min:1',
            'days.*.activities.*.activity_type' => 'required|string',
            'days.*.activities.*.additional_details' => 'nullable|string',
            'days.*.activities.*.referable_id' => 'required|integer',
            'days.*.activities.*.referable_type' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'tour_name.required' => 'The tour name is required.',
            'budget.required' => 'The budget is required.',
            'budget.numeric' => 'The budget must be a numeric value.',
            'start_date.required' => 'The start date is required.',
            'start_date.date' => 'The start date must be a valid date.',
            'end_date.required' => 'The end date is required.',
            'end_date.date' => 'The end date must be a valid date.',
            'end_date.after_or_equal' => 'The end date must be after or equal to the start date.',
            'number_of_people.required' => 'The number of people is required.',
            'number_of_people.integer' => 'The number of people must be an integer.',
            'number_of_people.min' => 'The number of people must be at least 1.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image.max' => 'The image must not be larger than 2048 kilobytes.',
            'days.required' => 'The days array is required.',
            'days.array' => 'The days must be an array.',
            'days.min' => 'There must be at least one day.',
            'days.max' => 'There cannot be more than the number of days between start and end dates.',
            'days.*.day_number.required' => 'Each day must have a day number.',
            'days.*.day_number.integer' => 'The day number must be an integer.',
            'days.*.activities.required' => 'Each day must have activities.',
            'days.*.activities.array' => 'Activities must be an array.',
            'days.*.activities.min' => 'Each day must have at least one activity.',
            'days.*.activities.*.activity_type.required' => 'The activity type is required.',
            'days.*.activities.*.activity_type.string' => 'The activity type must be a string.',
            'days.*.activities.*.additional_details.string' => 'The additional details must be a string.',
            'days.*.activities.*.referable_type.required' => 'The referable type is required.',
            'days.*.activities.*.referable_type.string' => 'The referable type must be a string.',
            'days.*.activities.*.referable_id.required' => 'The referable ID is required.',
            'days.*.activities.*.referable_id.integer' => 'The referable ID must be an integer.',
        ];
    }
}
