<?php

namespace App\Services;

use App\Models\User;


class OtpService
{
    public static function generateRandomOtp(int $otpLength = 4, User $user): string | null
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $maxAttempts = 100; // Avoid infinite loops by setting a limit on attempts
        $attempt = 0;

        do {
            $oneTimePassword = '';
            for ($i = 0; $i < $otpLength; $i++) {
                $oneTimePassword .= $characters[random_int(0, $charactersLength - 1)];
            }
            $attempt++;
        } while ($user->oneTimePasswords()->where('otp', $oneTimePassword)->exists() && $attempt <= $maxAttempts);

        if ($attempt > $maxAttempts) {
            return null; // or handle this case accordingly
        }

        return $oneTimePassword;
    }
}
