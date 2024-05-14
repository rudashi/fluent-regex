<?php

declare(strict_types=1);

namespace Rudashi\Patterns;

use Rudashi\Contracts\PatternContract;
use Rudashi\Pattern;

class CreditCardPattern extends Pattern implements PatternContract
{
    protected string $pattern = '(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14})';

    public static string $name = 'credit-card';
}
