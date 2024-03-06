<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

trait Tokens
{
    public function exactly(string $value): static
    {
        $this->pushToPattern($this->sanitize($value));

        return $this;
    }

    public function letter(): static
    {
        $this->pushToPattern('[a-zA-Z]');

        return $this;
    }

    public function letters(): static
    {
        $this->pushToPattern('[a-zA-Z]+');

        return $this;
    }

    public function lowerLetter(): static
    {
        $this->pushToPattern('[a-z]');

        return $this;
    }

    public function lowerLetters(): static
    {
        $this->pushToPattern('[a-z]+');

        return $this;
    }
}
