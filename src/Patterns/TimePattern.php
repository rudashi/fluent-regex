<?php

declare(strict_types=1);

namespace Rudashi\Patterns;

use Rudashi\Contracts\PatternContract;
use Rudashi\Pattern;

final class TimePattern extends Pattern implements PatternContract
{
    protected static string $name = 'time';

    protected string $pattern = '(?<!\d)(?:(?:[01]?\d|2[0-3]):(?:[0-5]\d)(?::(?:[0-5]\d))?(?! ?[AaPp][Mm])|(?:0?[1-9]|1[0-2]):(?:[0-5]\d)(?: ?[AaPp][Mm])?)';
}
