<?php

namespace App\Http\Controllers\Api\V1\Client;

use App\Enums\TripStatusEnum;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Trip\TripResource;
use Illuminate\Database\Query\Builder;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $trips = Trip::query()
            ->when(
                $request->boolean('is_ongoing'),
                fn (Builder $query) => $query->whereDate('end_date', '>', now()),
                fn (Builder $fallbackQuery) => $fallbackQuery->whereDate('end_date', '<=', now())
            )
            ->paginate(10);

        return response()->json(TripResource::collection($trips), Response::HTTP_OK);
    }


    /**
     * Display the specified resource.
     */
    public function show(Trip $trip) : JsonResponse
    {
        return response()->json(TripResource::make($trip), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trip $trip) : JsonResponse
    {
        if ($trip->is_rated) {
            return response()->json(['message' => 'Trip is already rated'], Response::HTTP_OK);
        }
        
        $trip->update(['status' => TripStatusEnum::CANCELLED]);
        $trip->feedback()->create($request->only('feedback') + ['user_id' => auth()->id()]);

        return response()->json(TripResource::make($trip), Response::HTTP_ACCEPTED);
    }
}
