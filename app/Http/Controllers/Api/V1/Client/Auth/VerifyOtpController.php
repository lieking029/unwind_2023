<?php

namespace App\Http\Controllers\Api\V1\Client\Auth;

use App\Enums\TokenAbilityEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Shared\VerifyOtpRequest;
use App\Http\Resources\Api\V1\User\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class VerifyOtpController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(VerifyOtpRequest $request) : JsonResponse
    {
        $user = auth()->user();

        $otp = $user->oneTimePasswords()
            ->where('otp', $request->otp)
            ->first();
        if (!$otp) {
            return response()->json(['message' => 'Invalid Otp request new if need'], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'authToken' => $user->createToken($request->ip(), [TokenAbilityEnum::AuthorizedToken])->accessToken,
            'user' => UserResource::make($user)
        ]);
    }
}
