<?php

declare(strict_types=1);

namespace App\Services;

class Time
{
    public const MINUTE_IN_SECONDS = 60;

    public const HOUR_IN_SECONDS = 60 * self::MINUTE_IN_SECONDS;

    public const DAY_IN_SECONDS = 24 * self::HOUR_IN_SECONDS;

    public const WEEK_IN_SECONDS = 7 * self::DAY_IN_SECONDS;

    public const MONTH_IN_SECONDS = 30 * self::DAY_IN_SECONDS;

    public const YEAR_IN_SECONDS = 365 * self::DAY_IN_SECONDS;
}
