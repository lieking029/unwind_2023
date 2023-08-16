<?php

namespace App\Services;

use App\Models\User;

class ReferralCodeService
{
    public static function generateVoucherCode(int $voucherLength = 9) : string | null
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $maxAttempts = 100; // Avoid infinite loops by setting a limit on attempts
        $attempt = 0;

        do {
            $voucherString = '';
            for ($i = 0; $i < $voucherLength; $i++) {
                $voucherString .= $characters[random_int(0, $charactersLength - 1)];
            }
            $attempt++;
        } while (User::where('voucher_code', $voucherString)->exists() && $attempt <= $maxAttempts);

        if ($attempt > $maxAttempts) {
            return null; // or handle this case accordingly
        }

        return $voucherString;
    }
}
