<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Client\LocationResource;
use App\Models\Location;

class LocationController extends Controller
{
    public function index() {
        $locations = Location::query()
            ->with(['resort', 'resort.media', 'resort.rooms'])
            ->withCount('resort')->get();
        return response()->json(
            LocationResource::collection($locations),
        );
    }



    public function show(Location $location) {
        $locations = tap(Location::search('')
            ->aroundLatLng($location->latitude, $location->longitude)->get(), function ($searchLocation) {
                $searchLocation->load(['resort', 'resort.media', 'resort.propertyType', 'resort.rooms']);
        });
        return response()->json(
            LocationResource::collection($locations),
        );
    }
}
