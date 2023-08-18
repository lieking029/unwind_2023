<?php

namespace App\Http\Resources\Api\V1\Room;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
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
            'bed_count' => $this->bed_count,
            'max_guest_count' => $this->max_guest_count,
            'bath_count' => $this->bath_count,
            'room_type' => $this->room_type,
            'price' => $this->price,
            // 'preview' => MediaResource::collection($this->whenLoaded('previews'))
        ];
    }
}
