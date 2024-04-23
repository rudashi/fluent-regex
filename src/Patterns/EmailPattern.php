<?php

declare(strict_types=1);

namespace Rudashi\Patterns;

use Rudashi\Contracts\PatternContract;

class EmailPattern implements PatternContract
{
    protected string $pattern = '\w+(?:\.\w+)*@(?:[\w-]+\.)+[\w-]{2,}';

    public static string $name = 'email';

    public function getName(): string
    {
        return static::$name;
    }

    public function getPattern(): string
    {
        return $this->pattern;
    }
}
