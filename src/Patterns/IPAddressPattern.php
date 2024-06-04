<?php

declare(strict_types=1);

namespace Rudashi\Patterns;

use Rudashi\Contracts\PatternContract;
use Rudashi\Pattern;

final class IPAddressPattern extends Pattern implements PatternContract
{
    protected string $pattern = '((25[0-5]|(2[0-4]|1\d|[1-9]|)\d)\.?\b){4}';

    public static string $name = 'ipAddress';
}
