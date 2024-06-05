<?php

declare(strict_types=1);

namespace Rudashi\Patterns;

use Rudashi\Contracts\PatternContract;
use Rudashi\Pattern;

final class EmailPattern extends Pattern implements PatternContract
{
    public static string $name = 'email';

    protected string $pattern = '\w+(?:[.-]\w+)*@([\w-]+\.)+[\w-]{2,}';
}
