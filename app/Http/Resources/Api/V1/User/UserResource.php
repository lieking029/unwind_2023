<?php

namespace App\Http\Resources\Api\V1\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\V1\Address\AddressResource;

class UserResource extends JsonResource
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
            'fullName' => $this->fullname,
            'dateOfBirth' => $this->dob,
            'isVerified' => $this->is_verified,
            'email' => $this->email,
            'referralCode' => $this->my_referral_code,
            'address' => AddressResource::make($this->whenLoaded('address')),
            // 'profile' => MediaResource::collection($this->whenLoaded('profile'))
        ];
    }
}
