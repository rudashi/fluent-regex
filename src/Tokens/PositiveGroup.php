<?php

declare(strict_types=1);

namespace Rudashi\Tokens;

use Rudashi\Contracts\TokenContract;

final class PositiveGroup implements TokenContract
{
    public function __construct(
        private readonly bool $lookbehind = false,
        private readonly bool $lookahead = false,
    ) {
    }

    public function __toString(): string
    {
        return ($this->lookbehind ? '?<=' : '') . ($this->lookahead ? '?=' : '');
    }

    public function getToken(): string
    {
        return $this->__toString();
    }
}
