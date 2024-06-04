<?php

declare(strict_types=1);

namespace Rudashi\Patterns;

use Rudashi\Contracts\PatternContract;
use Rudashi\Pattern;

final class MACAddressPattern extends Pattern implements PatternContract
{
    protected string $pattern = '(?<![0-9A-Fa-f.:-])(?:[0-9A-Fa-f]{2}[:.-]){5}(?:[0-9A-Fa-f]{2})(?![0-9A-Fa-f:-])';

    public static string $name = 'macAddress';
}
