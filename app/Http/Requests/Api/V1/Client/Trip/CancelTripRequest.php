<?php

namespace App\Http\Requests\Api\V1\Client\Trip;

use Illuminate\Foundation\Http\FormRequest;

class CancelTripRequest extends FormRequest
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
            'feedback' => ['nullable', 'string'],
        ];
    }
}
