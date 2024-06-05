<?php

declare(strict_types=1);

namespace Rudashi\Patterns;

use Rudashi\Contracts\PatternContract;
use Rudashi\Pattern;

final class UrlPattern extends Pattern implements PatternContract
{
    public static string $name = 'url';

    protected string $pattern = 'https?\:\/\/[^-][a-z\d.-]+[^-]\.[a-z]{2,}(\/[a-z\d\/-]*)?';
}
