<?php

declare(strict_types=1);

namespace Rudashi\Patterns;

use Rudashi\Contracts\PatternContract;
use Rudashi\Pattern;

class EmailPattern extends Pattern implements PatternContract
{
    protected string $pattern = '\w+(?:[\.\-]\w+)*@([\w-]+\.)+[\w-]{2,}';

    public static string $name = 'email';
}
