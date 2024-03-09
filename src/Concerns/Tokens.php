<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

trait Tokens
{
    public function exactly(string|int $value): static
    {
        $this->pushToPattern($this->sanitize((string) $value));

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

    public function whitespace(): static
    {
        $this->pushToPattern('\s');

        return $this;
    }

    public function nonWhitespace(): static
    {
        $this->pushToPattern('\S');

        return $this;
    }

    public function digit(): static
    {
        $this->pushToPattern('\d');

        return $this;
    }

    public function digits(): static
    {
        $this->pushToPattern('\d+');

        return $this;
    }
}
