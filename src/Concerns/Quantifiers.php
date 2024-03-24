<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

trait Quantifiers
{
    public function zeroOrOne(): static
    {
        $this->pushToPattern('?');

        return $this;
    }

    public function zeroOrMore(): static
    {
        $this->pushToPattern('*');

        return $this;
    }

    public function oneOrMore(): static
    {
        $this->pushToPattern('+');

        return $this;
    }

    public function times(int $number): static
    {
        $this->pushToPattern('{' . $number . '}');

        return $this;
    }

    public function min(int $number): static
    {
        $this->between($number);

        return $this;
    }

    public function between(int $min, int $max = null): static
    {
        $this->pushToPattern('{' . $min . ',' . $max . '}');

        return $this;
    }
}
