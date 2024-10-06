<?php

declare(strict_types=1);

namespace Rudashi\Patterns;

use Rudashi\Contracts\PatternContract;
use Rudashi\Pattern;

final class CreditCardPattern extends Pattern implements PatternContract
{
    protected static string $name = 'credit-card';

    protected string $pattern = '(?:4\d{12}(?:\d{3})?|5[1-5]\d{14})';
}
