<?php

namespace App\Http\Requests\Api\V1\Client;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonalInformationRequest extends FormRequest
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
            'fullname' => ['required', 'string'],
            'email' => ['required', 'strign', 'unique:users,email,'. auth()->id()],
            'dob' => ['required', 'date'],
            'home_address' => ['required', 'string'],
            'barangay' => ['required', 'string'],
            'city' => ['required', 'stringn'],
            'region' => ['required', 'string'],
            'country' => ['required', 'string']
        ];
    }
}
