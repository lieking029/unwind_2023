<?php

namespace App\Http\Requests\Api\V1\Client;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => ['required', 'string', 'max:50'],
            'phone_number' => ['required', 'string', 'unique:users,phone_number'],
            'dob' => ['required', 'date'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'referral_code' => ['nullable', 'string', 'min:9', 'max:9', 'exists:users,my_referral_code'],
        ];
    }
}
