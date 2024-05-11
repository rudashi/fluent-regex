<?php

declare(strict_types=1);

namespace Rudashi\Contracts;

interface PatternContract
{
    /**
     * Get the pattern alias name.
     *
     * @return string
     */
    public function alias(): string;

    /**
     * Get the name of the pattern.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Returns the current regular expression pattern.
     *
     * @return string
     */
    public function getPattern(): string;
}
