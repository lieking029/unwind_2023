<?php

namespace App\Http\Requests\Api\V1\Client;

use Illuminate\Foundation\Http\FormRequest;

class StoreSocialLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'social_id' => ['required', 'string'],
            'social_type' => ['required', 'string'],
            'email' => ['required', 'email'],
            'fullname' => ['required', 'string'],
            'picture' => ['required', 'active_url'],
            'dob' => ['nullable', 'date'],
        ];
    }
}
