<?php

namespace App\Http\Resources\Api\V1\Resort;

use Illuminate\Http\Request;
use App\Http\Resources\Api\V1\Room\RoomResource;
use App\Http\Resources\Api\V1\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\V1\Addon\AddonResource;
use App\Http\Resources\Api\V1\Amenity\AmenityResource;
use App\Http\Resources\Api\V1\Feedback\FeedbackResource;
use App\Http\Resources\Api\V1\Location\LocationResource;
use App\Http\Resources\Api\V1\Wishlist\WishlistResource;
use App\Http\Resources\Api\V1\PropertyType\PropertyTypeResource;

class ResortResource extends JsonResource
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
            'property_name' => $this->name,
            'price' => (float)$this->price,
            'visibility' => $this->visibility,
            'description' => $this->description,
            'during_stay_guide' => $this->during_stay_guide,
            // 'avg_rating' => $this->ratingsAvg(),
            // 'current_rating_count' => $this->ratingsCount(),
            'merchant' => UserResource::make($this->whenLoaded('merchant')),
            'property_type' => PropertyTypeResource::make($this->whenLoaded('propertyType')),
            'amenities' => AmenityResource::collection($this->whenLoaded('amenities')),
            'rooms' => RoomResource::collection($this->whenLoaded('rooms')),
            'addons' => AddonResource::collection($this->whenLoaded('addons')),
            'location' => LocationResource::make($this->whenLoaded('location')),
            // 'preview' => MediaResource::collection($this->whenLoaded('media')),
            'feedbacks' => FeedbackResource::collection($this->whenLoaded('feedbacks')),
            'wishlists' => WishlistResource::collection($this->whenLoaded('wishlist')),
            'feedbacksCount' => (int)$this->feedbacks_count ?? 0,
        ];
    }
}
