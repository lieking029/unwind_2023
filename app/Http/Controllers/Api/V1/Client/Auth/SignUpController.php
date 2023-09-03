<?php

namespace App\Http\Controllers\Api\V1\Client\Auth;

use App\Enums\TokenAbilityEnum;
use App\Models\User;
use App\Services\OtpService;
use App\Services\SmsService;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\User\UserResource;
use App\Http\Requests\Api\V1\Client\StoreUserRequest;
use Illuminate\Http\JsonResponse;

class SignUpController extends Controller
{
    public function __invoke(StoreUserRequest $request): JsonResponse
    {
        $user = User::create($request->validated());
        $user->oneTimePasswords()->create([
            'otp' => OtpService::generateRandomOtp(user: $user), 
            'expires_at' => now()->addMinutes(5)
        ]);
        
        SmsService::sendVerificationOTP(phoneNumber: $user->phone_number, otp: $user->otp);
        return response()->json([
            'authToken' => $user->createToken($request->ip(), [TokenAbilityEnum::OtpVerify])->accessToken,
            'user' => UserResource::make($user),
        ], Response::HTTP_OK);
    }
}
