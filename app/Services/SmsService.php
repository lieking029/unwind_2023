<?php


namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;

class SmsService {

    public static function sendVerificationOTP(string $phoneNumber,  string $otp) {
        Http::post("https://api.semaphore.co/api/v4/priority", [
            "apikey" => config('services.semaphore.api_key'),
            "number" => $phoneNumber,
            "message" => '[Unwind]\nYour One Time Password is '. $otp,
        ]);
    }
}
