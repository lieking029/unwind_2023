<?php

namespace App\Http\Controllers\Api\V1\Client;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Trip\TripResource;
use App\Http\Requests\Api\V1\Client\Trip\RateTripRequest;

class RateTripController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RateTripRequest $request, Trip $trip) : JsonResponse
    {
        if ($trip->is_rated) {
            return response()->json(['message' => 'Trip already rated'], Response::HTTP_OK);
        }

        $trip->feedback()->create($request->only('feedback') + ['user_id' => auth()->id()]);
        auth()->user()->rate($trip->resort, $request->rating);

        return response()->json(TripResource::make($trip), Response::HTTP_ACCEPTED);
    }
}
