<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'restaurant_name' => 'string|max:255',
            'location_id' => 'integer|exists:locations,id',
            'cuisine' => 'string|max:255',
            'description' => 'string',
            'image' => 'nullable|image|max:2048',
            'rating' => 'numeric|min:1|max:5',
            'price_range' => 'string|max:255',
        ];
    }
}
