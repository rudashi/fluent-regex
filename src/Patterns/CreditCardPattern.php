<?php

declare(strict_types=1);

namespace Rudashi\Patterns;

use Rudashi\Contracts\PatternContract;
use Rudashi\Pattern;

final class CreditCardPattern extends Pattern implements PatternContract
{
    public static string $name = 'credit-card';

    protected string $pattern = '(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14})';
}
