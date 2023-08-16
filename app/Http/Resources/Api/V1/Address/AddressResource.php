<?php

namespace App\Http\Resources\Api\V1\Address;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'home_address' => $this->home_address,
            'barangay' => $this->barangay,
            'city' => $this->city,
            'region' => $this->region,
            'country' => $this->country,
        ];
    }
}
