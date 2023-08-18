<?php

namespace App\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Client\Wishlist\StoreWishlistRequest;
use App\Http\Resources\Api\V1\Wishlist\WishlistResource;
use App\Models\Wishlist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        $wishlists = auth()->user()->wishlists()
            ->paginate(10);

        return response()->json(WishlistResource::collection($wishlists), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWishlistRequest $request)
    {
        $wishlist = auth()->users()->wishlists()
            ->updateOrCreate($request->validated(), ['resort_id']);

        return response()->json(WishlistResource::make($wishlist), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Wishlist $wishlist) : JsonResponse
    {
        return response()->json(WishlistResource::make($wishlist), Response::HTTP_OK);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wishlist $wishlist) : JsonResponse
    {
        $wishlist->delete();

        return response()->json(WishlistResource::make($wishlist), Response::HTTP_NO_CONTENT);
    }
}
