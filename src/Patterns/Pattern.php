<?php

declare(strict_types=1);

namespace Rudashi\Patterns;

abstract class Pattern
{
    protected string $pattern;

    public static string $name;

    public function alias(): string
    {
        return lcfirst(implode('', array_map(
            callback: static fn ($word) => ucfirst(strtolower($word)),
            array: explode(' ', str_replace(['-', '_'], ' ', static::$name))
        )));
    }

    public function getName(): string
    {
        return static::$name;
    }

    public function getPattern(): string
    {
        return $this->pattern;
    }
}
