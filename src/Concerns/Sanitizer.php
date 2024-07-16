<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

trait Sanitizer
{
    /**
     * Sanitize the given expression value.
     */
    public static function sanitize(string|int $value): string
    {
        $value = (string) $value;

        return $value !== '' ? preg_quote($value, '/') : $value;
    }
}
