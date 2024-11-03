<?php

declare(strict_types=1);

namespace Rudashi\Tokens;

use LogicException;
use Rudashi\Contracts\TokenContract;

final readonly class Group implements TokenContract
{
    public function __construct(
        private TokenContract $group,
    ) {
    }

    public function __toString(): string
    {
        return $this->group->getToken();
    }

    public static function make(bool $lookbehind = false, bool $lookahead = false, bool $negative = false): self
    {
        if ($lookbehind && $lookahead) {
            throw new LogicException('Unable to look behind and ahead at the same time.');
        }

        return new self(match ($negative) {
            true => new NegativeGroup($lookbehind, $lookahead),
            false => new PositiveGroup($lookbehind, $lookahead),
        });
    }

    public function getToken(): string
    {
        return $this->__toString();
    }
}
