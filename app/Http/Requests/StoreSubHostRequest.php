<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubHostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => 'required|max:255|string',
            'email' => 'required|max:255|string|email',
            'phone_number' => 'required|numeric',
            'dob' => 'required|required|date|before:2004-01-01',
            'password' => 'required|min:8|confirmed',
        ];
    }
}
