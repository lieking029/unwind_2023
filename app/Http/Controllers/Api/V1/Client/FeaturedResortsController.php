<?php

namespace App\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Resort\ResortResource;
use App\Models\Resort;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FeaturedResortsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $featuredResorts = Resort::query()
            ->with(['propertyType', 'media', 'location', 'wishlist'])
            ->withCount(['transaction', 'feedbacks'])
            ->leftJoin('ratings', function ($query) {
                $query->on('ratings.model_id', '=', 'resorts.id')
                    ->where('ratings.model_type', '=', 'App\Http\User');
            })
            ->orderBy('transactions_count')
            ->orderBy('feedbacks_count')
            ->orderBy('ratings.value')
            ->paginate(10);

        return response()->json(ResortResource::make($featuredResorts), Response::HTTP_OK);
    }
}
