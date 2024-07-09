<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHistoricalSiteRequest extends FormRequest
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
            'location_id' => 'integer',
            'site_name' => 'string|max:100',
            'description' => 'string|max:255',
            'image' => 'nullable|image|max:2048',
            'entry_fees' => 'nullable|numeric',
            'rating' => 'numeric|between:0,5',
            'opening_hours' => 'nullable|string',
        ];
    }
}