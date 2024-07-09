<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true; // everyone can attempt to register
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z]).+$/|confirmed',
        ];
    }


    public function messages()
    {
        return [
            'password.regex' => 'The password must include at least one uppercase and one lowercase letter.',
            'password.confirmed' => 'The password confirmation does not match.',
        ];
    }
}
