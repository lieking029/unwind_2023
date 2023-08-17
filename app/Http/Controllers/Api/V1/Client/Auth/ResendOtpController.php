<?php

namespace App\Http\Controllers\Api\V1\Client\Auth;

use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\SmsService;

class ResendOtpController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request) : JsonResponse
    {
        $otp = OtpService::generateRandomOtp(user: auth()->user());
        if (!$otp) {
            return response()->json(['message' => 'Try again.'], Response::HTTP_BAD_REQUEST);
        }
        
        auth()->user()->oneTimePasswords()->create(['otp' => $otp, 'expires_at' => now()->addMinutes(5)]);
        SmsService::sendVerificationOTP(phoneNumber: auth()->user()->phone_number, otp: $otp);
        
        return response()->json([
            'message' => 'Resend Otp sucessfully',
        ], Response::HTTP_OK);
    }
}
