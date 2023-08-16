<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TokenAbilityEnum extends Enum
{
    const OtpVerify = 'pin-verify';
    const ResetOtpVerify = 'reset-password-verify';
    const AuthorizedToken = 'authorized';
}
