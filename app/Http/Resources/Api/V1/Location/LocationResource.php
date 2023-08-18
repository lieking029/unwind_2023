<?php

namespace App\Http\Resources\Api\V1\Location;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\V1\Resort\ResortResource;

class LocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'streetNumber' => $this->street_number,
            'streetName' => $this->street_name,
            'barangayName' => $this->barangay_name,
            'postalCode' => $this->postal_coded,
            'region' => $this->region,
            'country' => $this->country,
            'latitude' => (float) $this->latitude,
            'longitude' => (float) $this->longitude,
            'description' => $this->description,
            'resort' => ResortResource::make($this->whenLoaded('resort')),
            'resortsCount' => $this->resort_count ?? 0,
        ];
    }
}
