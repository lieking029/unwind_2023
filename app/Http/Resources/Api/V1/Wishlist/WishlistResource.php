<?php

namespace App\Http\Resources\Api\V1\Wishlist;

use App\Http\Resources\Api\V1\Resort\ResortResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WishlistResource extends JsonResource
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
            'resort' => ResortResource::make($this->whenLoaded('resort')),
            'wishedListAt' => $this->created_at,
        ];
    }
}
