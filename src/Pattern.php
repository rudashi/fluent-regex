<?php

declare(strict_types=1);

namespace Rudashi;

abstract class Pattern
{
    /**
     * A shortened name identifying the pattern.
     */
    protected static string $name;

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
            callback: static fn ($word): string => ucfirst(strtolower($word)),
            array: explode(' ', str_replace(['-', '_'], ' ', $this->getName()))
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
