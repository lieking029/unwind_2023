<?php

namespace App\Http\Controllers\Api\V1\Client\Auth;

use App\Enums\TokenAbilityEnum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\OtpService;
use App\Services\SmsService;

class ForgotPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request) : JsonResponse
    {
        $forgotUser = User::where('phone_number', $request->phone_number)->first();
        if (!$forgotUser) {
            return response()->json(['message' => 'Invalid Email or Mobile number'], Response::HTTP_BAD_REQUEST);
        }

        $otp = $forgotUser->oneTimePasswords()->create([
            'otp' => OtpService::generateRandomOtp(user: $forgotUser), 
            'expires_at' => now()->addMinutes(5)
        ]);
        SmsService::sendVerificationOTP(phoneNumber: $forgotUser->phone_number, otp: $otp->otp);

        return response()->json([
            'authToken' => $forgotUser->createToken($request->ip(), [TokenAbilityEnum::ResetOtpVerify])->accessToken,
        ]);
    }
}
