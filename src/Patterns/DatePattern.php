<?php

declare(strict_types=1);

namespace Rudashi\Patterns;

use Rudashi\Contracts\PatternContract;
use Rudashi\Pattern;

final class DatePattern extends Pattern implements PatternContract
{
    protected static string $name = 'date';

    protected string $pattern = '\b(?:(?:\d{4})[-\/.](?:0?[1-9]|1[0-2])[-\/.](?:0?[1-9]|[12][0-9]|3[01])|(?:0?[1-9]|[12][0-9]|3[01])[-\/.](?:0?[1-9]|1[0-2])[-\/.](?:\d{4})|(?:0?[1-9]|1[0-2])[-\/.](?:0?[1-9]|[12][0-9]|3[01])[-\/.](?:\d{4}))\b';
}
