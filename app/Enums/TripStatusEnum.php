<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static CANCELLED()
 * @method static static APPROVED()
 * @method static static ONGOING()
 * @method static static FINISHED()
 */
final class TripStatusEnum extends Enum
{
    const PENDING = 0;
    const CANCELLED = 1;
    const APPROVED = 2;
    const ONGOING = 3;
    const FINISHED = 4;
}
