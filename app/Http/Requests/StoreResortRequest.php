<?php

namespace App\Http\Requests;

use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:50'],
            'price' => ['required', 'numeric'],
            'visibility' => ['required',  new EnumValue(ResortVisibilityEnum::class, false)],
            'property_description' => ['required', 'string', 'max:255'],
            'property_type_id' => ['required', 'exists:property_types,id'],
            'featured_media' => ['nullable', File::image()],
            'street_number' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'max:4'],
            'barangay_district' => ['required', 'string', 'max:100'],
            'street_name' => ['required', 'string', 'max:100'],
            'location_description' => ['required', 'string', 'max:255'],
            'subhost_name' => ['required', 'string', 'max:25'],
            'email' => ['required', 'email'],
            'phone_number' => ['required', 'string', 'max:11'],
            'password' => ['required', 'string', Password::min(8)->uncompromised()],
        ];
    }
}
