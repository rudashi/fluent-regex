<?php

declare(strict_types=1);

namespace Rudashi;

abstract class Pattern
{
    /**
     * The base regex pattern.
     *
     * @var string
     */
    protected string $pattern;

    /**
     * A shortened name identifying the pattern.
     *
     * @var string
     */
    public static string $name;

    /**
     * Get the pattern alias name.
     *
     * @return string
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
     *
     * @return string
     */
    public function getName(): string
    {
        return static::$name;
    }

    /**
     * Returns the current regular expression pattern.
     *
     * @return string
     */
    public function getPattern(): string
    {
        return $this->pattern;
    }
}
