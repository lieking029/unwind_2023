<?php

namespace App\Http\Controllers\Api\Client\Auth;

use App\Enums\TokenAbilityEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\User\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MeController extends Controller
{
    public function __invoke(Request $request) : JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'authToken' => $user->createToken($request->ip(), [TokenAbilityEnum::AuthorizedToken])->accessToken,
            'user' => UserResource::make($user),
        ]);
    }
}
