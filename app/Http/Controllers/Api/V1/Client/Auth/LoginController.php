<?php

namespace App\Http\Controllers\Api\Client\Auth;

use App\Enums\TokenAbilityEnum;
use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\V1\Shared\LoginRequest;
use App\Http\Resources\Api\V1\User\UserResource;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request) : JsonResponse
    {
        $user = User::with(['address', 'profile'])->where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid Email or Password'], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'authToken' => $user->createToken($request->ip(), [TokenAbilityEnum::AuthorizedToken])->accessToken,
            'user' => UserResource::make($user),
        ], Response::HTTP_OK);
    }
}
