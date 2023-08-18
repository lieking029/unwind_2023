<?php

namespace App\Http\Resources\Api\V1\Trip;

use App\Enums\TripStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\V1\Resort\ResortResource;

class TripResource extends JsonResource
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
            'startDate' => $this->start_date,
            'endDate' => $this->end_date,
            'price' => $this->price,
            'referenceNumber' => $this->reference_number,
            'status' => $this->status,
            'participants' => $this->participants_count,
            'isCancellable' => $this->whenLoaded('resort', function () {
                if ($this->resort->has_cancellation_policy && $this->start_date->diffInHours(now()) < 12) {
                    return false;
                }
                if ($this->status == TripStatusEnum::CANCELLED) {
                    return false;
                }
                return true;
            }),
            'isRated' => $this->is_rated,
        ];
    }
}
