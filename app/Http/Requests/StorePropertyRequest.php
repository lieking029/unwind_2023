<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class StoreResortRequest extends FormRequest
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
            'name' => ['required'],
            'price' => ['required'],
            'visibility' => ['required'],
            'description' => ['required'],
            'property_type_id' => ['required', 'exists:property_types,id'],
            'fMedia' => ['nullable', 'image'],
            'loc_details' => ['required'],
            'street_number' => ['required'],
            'postal_code' => ['required'],
            'barangay_district' => ['required'],
            'street_name' => ['required'],
            'loc_description' => ['required'],
            'h_name' => ['required'],
            'email' => ['required', 'email'],
            'phone_number' => ['required'],
            'password' => ['required'],
        ];
    }
}
