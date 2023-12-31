<?php

namespace App\Http\Requests\Web\Resort;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class UpdatePropertyRequest extends FormRequest
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
            'price' => ['required', 'numeric', 'max:99999999'],
            'visibility' => ['required'],
            'description' => ['required', 'string', 'max:255'],
            'property_type_id' => ['required', 'exists:property_types,id'],
            'featured_media' => ['nullable', File::image()],
            'subhost_id.*' => 'nullable|exists:users,id',
            'amenities.*' => 'nullable|exists:amenities,id',
            'addons.*' => 'nullable|exists:addons,id',
            'street_number' => 'required|string|max:255',
            'barangay_district' => 'required|string|max:255',
            'postal_code' => 'required|numeric',
            'street_name' => 'nullable|string|max:255',
            'location_description' => 'required|max:255|string'
        ];
    }
}
