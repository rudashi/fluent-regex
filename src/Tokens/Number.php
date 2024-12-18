<?php

declare(strict_types=1);

namespace Rudashi\Tokens;

use LogicException;
use Rudashi\Contracts\TokenContract;

final readonly class Number implements TokenContract
{
    private const MIN = 0;
    private const MAX = 9;

    public function __construct(
        private int $min,
        private int $max,
    ) {
        if ($this->min < self::MIN || $this->min > self::MAX - 1) {
            $this->throwLogicException();
        }

        if ($this->max < 1 || $this->max > self::MAX) {
            $this->throwLogicException();
        }
    }

    public function __toString(): string
    {
        return $this->min . '-' . $this->max;
    }

    public static function make(int $min = self::MIN, int $max = self::MAX): self
    {
        return new self($min, $max);
    }

    public function getToken(): string
    {
        return $this->__toString();
    }

    private function throwLogicException(): never
    {
        throw new LogicException(sprintf('The number range must be between [%d-%d].', self::MIN, self::MAX));
    }
}
