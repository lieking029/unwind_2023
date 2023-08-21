<?php

namespace App\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Resort\ResortResource;
use App\Models\Resort;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ResortController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $resorts = Resort::query()
            ->with(['media', 'location', 'propertyType']) 
            ->withCount(['feedbacks', 'rooms'])
            ->paginate(10);

        return response()->json(ResortResource::make($resorts), Response::HTTP_OK);
    }


    /**
     * Display the specified resource.
     */
    public function show(Resort $resort)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resort $resort)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resort $resort)
    {
        //
    }
}
