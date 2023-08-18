<?php

namespace App\Http\Controllers\Api\V1\Client;

use App\Enums\TripStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Client\Trip\CancelTripRequest;
use App\Http\Resources\Api\V1\Trip\TripResource;
use App\Models\Trip;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CancelTripController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CancelTripRequest $request, Trip $trip) : JsonResponse
    {
        $trip->update(['status' => TripStatusEnum::CANCELLED]);
        
        if ($request->feedback) {
            $trip->feedback()->create($request->only('feedback') + ['user_id' => auth()->id()]);
        }

        return response()->json(TripResource::make($trip), Response::HTTP_OK);
    }
}
