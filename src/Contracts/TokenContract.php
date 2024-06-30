<?php

declare(strict_types=1);

namespace Rudashi\Contracts;

interface TokenContract
{
    /**
     * Get string representative of token.
     */
    public function __toString(): string;

    /**
     * Get token pattern.
     */
    public function getToken(): string;
}
