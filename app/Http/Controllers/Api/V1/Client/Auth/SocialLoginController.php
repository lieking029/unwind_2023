<?php

namespace App\Http\Controllers\Api\V1\Client\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\User\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SocialLoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request) : JsonResponse
    {
        $socialExists = User::where($request->social_type. '_id', $request->social_id)->first();
        if ($socialExists) {
            return response()->json([
                'authToken' => $socialExists->createToken($request->ip())->accessToken,
                'user' => UserResource::make($socialExists), 
            ], Response::HTTP_OK);
        }

        $createUser = User::create($request->except('social_type', 'social_id') + [
            'password' => config('app.default_password'),
            $request->social_type. '_id' => $request->social_id,
            'is_verified' => true,
        ]);

        return response()->json([
            'authToken' => $createUser->createToken($request->ip())->accessToken,
            'user' => UserResource::make($createUser),
        ], Response::HTTP_CREATED);
    }
}
