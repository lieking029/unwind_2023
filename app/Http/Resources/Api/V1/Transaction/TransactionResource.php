<?php

namespace App\Http\Resources\Api\V1\Transaction;

use App\Http\Resources\Api\V1\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'merchant' => UserResource::make($this->whenLoaded('merchant')),
            'user' => UserResource::make($this->whenLoaded('user')),
            'referenceNumber' => $this->reference_number,
            'paymentMethod' => $this->payment_method,
            'amountDue' => $this->amount_due,
            'createdAt' => $this->created_at,
            'resort' => $this->whenLoaded('resort', fn () => $this->resort->name),
        ];
    }
}
