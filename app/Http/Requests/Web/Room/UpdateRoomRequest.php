<?php

namespace App\Http\Requests\Web\Room;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class UpdateRoomRequest extends FormRequest
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
            'rooms' => 'required|array',
            'rooms. * .max_guest_count' => 'required|numeric',
            'rooms. * .room_image' => ['nullable', File::image()],
            'rooms. * .bed_count' => 'required|numeric',
            'rooms. * .bath_count' => 'required|numeric',
            'rooms. * .price' => 'required',
        ];
    }
}
