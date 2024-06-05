<?php

declare(strict_types=1);

namespace Rudashi;

abstract class Pattern
{
    /**
     * A shortened name identifying the pattern.
     */
    public static string $name;

    /**
     * The base regex pattern.
     */
    protected string $pattern;

    /**
     * Get the pattern alias name.
     */
    public function alias(): string
    {
        return lcfirst(implode('', array_map(
            callback: static fn ($word) => ucfirst(strtolower($word)),
            array: explode(' ', str_replace(['-', '_'], ' ', static::$name))
        )));
    }

    /**
     * Get the name of the pattern.
     */
    public function getName(): string
    {
        return static::$name;
    }

    /**
     * Returns the current regular expression pattern.
     */
    public function getPattern(): string
    {
        return $this->pattern;
    }
}
