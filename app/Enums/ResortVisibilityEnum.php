<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Private()
 * @method static static Public()
 */
final class ResortVisibilityEnum extends Enum
{
    const Private = 0;
    const Public = 1;
}
