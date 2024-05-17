<?php

declare(strict_types=1);

namespace Rudashi\Patterns;

use Rudashi\Contracts\PatternContract;
use Rudashi\Pattern;

class UrlPattern extends Pattern implements PatternContract
{
    protected string $pattern = 'https?\:\/\/[^-][a-z\d.-]+[^-]\.[a-z]{2,}(\/[a-z\d\/-]*)?';

    public static string $name = 'url';
}
