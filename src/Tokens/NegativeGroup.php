<?php

declare(strict_types=1);

namespace Rudashi\Tokens;

use Rudashi\Contracts\TokenContract;

final readonly class NegativeGroup implements TokenContract
{
    public function __construct(
        private bool $lookbehind = false,
        private bool $lookahead = false,
    ) {
    }

    public function __toString(): string
    {
        if (! $this->lookbehind && ! $this->lookahead) {
            return '?:';
        }

        return ($this->lookbehind ? '?<!' : '') . ($this->lookahead ? '?!' : '');
    }

    public function getToken(): string
    {
        return $this->__toString();
    }
}
