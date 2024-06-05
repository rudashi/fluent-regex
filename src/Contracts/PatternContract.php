<?php

declare(strict_types=1);

namespace Rudashi\Contracts;

interface PatternContract
{
    /**
     * Get the pattern alias name.
     */
    public function alias(): string;

    /**
     * Get the name of the pattern.
     */
    public function getName(): string;

    /**
     * Returns the current regular expression pattern.
     */
    public function getPattern(): string;
}
