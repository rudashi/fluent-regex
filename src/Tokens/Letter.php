<?php

declare(strict_types=1);

namespace Rudashi\Tokens;

use LogicException;
use Rudashi\Contracts\TokenContract;

final class Letter implements TokenContract
{
    private const FIRST = 'a';
    private const LAST = 'z';

    public function __construct(
        private readonly string $first,
        private readonly string $last,
        private readonly bool $onlyLower = false,
    ) {
        if (! in_array($this->first, range('a', 'y'), true)) {
            $this->throwLogicException('The first letter must be between [a-y].');
        }

        if (! in_array($this->last, range('b', 'z'), true)) {
            $this->throwLogicException('The last letter must be between [b-z].');
        }
    }

    public function __toString(): string
    {
        return implode('', [
            $this->first . '-' . $this->last,
            $this->onlyLower ? '' : strtoupper($this->first) . '-' . strtoupper($this->last),
        ]);
    }

    public static function make(string $first = self::FIRST, string $last = self::LAST, bool $lower = false): self
    {
        return new self(strtolower($first), strtolower($last), $lower);
    }

    public function getToken(): string
    {
        return $this->__toString();
    }

    private function throwLogicException(string $message): never
    {
        throw new LogicException($message);
    }
}
