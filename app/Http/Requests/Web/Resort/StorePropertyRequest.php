<?php

namespace App\Http\Requests\Web\Resort;

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
            'visibility' => ['required'],
            'description' => ['required', 'string', 'max:255'],
            'property_type_id' => ['required', 'exists:property_types,id'],
            'featured_media' => ['nullable', 'min:1', 'array'],
            'featured_media.*' => ['nullable', 'string'],
            'subhost_id.*' => 'nullable|exists:users,id',
            'amenities.*' => 'nullable|exists:amenities,id',
            'addons.*' => 'nullable|exists:addons,id',
            'addons_price.*' => 'nullable|numeric',
            'street_number' => 'required|string|max:255',
            'street_name' => 'nullable|string|max:255',
            'landmark' => 'required|max:255|string',
            'region_id' => 'required',
            'barangay_id' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ];
    }
}
