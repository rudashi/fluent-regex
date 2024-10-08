<?php

declare(strict_types=1);

namespace Rudashi\Tokens;

use Rudashi\Contracts\TokenContract;

final readonly class PositiveGroup implements TokenContract
{
    public function __construct(
        private bool $lookbehind = false,
        private bool $lookahead = false,
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
