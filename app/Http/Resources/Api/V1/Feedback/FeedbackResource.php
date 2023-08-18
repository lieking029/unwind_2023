<?php

namespace App\Http\Resources\Api\V1\Feedback;

use Illuminate\Http\Request;
use App\Http\Resources\Api\V1\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackResource extends JsonResource
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
            'feedback' => $this->feedback,
            'feedbackAt' => $this->created_at,
            'user' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}
