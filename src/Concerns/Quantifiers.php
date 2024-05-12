<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

use LogicException;
use Rudashi\Quantifier;

trait Quantifiers
{
    public function zeroOrOne(): static
    {
        $this->pushToPattern(Quantifier::ZERO_OR_ONE);

        return $this;
    }

    public function zeroOrMore(): static
    {
        $this->pushToPattern(Quantifier::ZERO_OR_MORE);

        return $this;
    }

    public function oneOrMore(): static
    {
        $this->pushToPattern(Quantifier::ONE_OR_MORE);

        return $this;
    }

    public function times(int $number): static
    {
        if ($number < 0) {
            $this->throwNegativeIntegerException('number');
        }

        $this->pushToPattern('{' . $number . '}');

        return $this;
    }

    public function min(int $number): static
    {
        if ($number < 0) {
            $this->throwNegativeIntegerException('number');
        }

        $this->between($number);

        return $this;
    }

    public function between(int $min, int $max = null): static
    {
        if ($min < 0) {
            $this->throwNegativeIntegerException('min');
        }

        if ($max !== null && $max < 0) {
            $this->throwNegativeIntegerException('max');
        }

        $this->pushToPattern('{' . $min . ',' . $max . '}');

        return $this;
    }

    private function throwNegativeIntegerException(string $parameter): void
    {
        throw new LogicException(sprintf('The "%s" parameter must be a positive integer.', $parameter));
    }
}
