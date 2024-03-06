<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

trait Tokens
{
    public function exactly(string $value): static
    {
        $this->pattern[] = $this->sanitize($value);

        return $this;
    }

    public function letter(): static
    {
        $this->pattern[] = '[a-zA-Z]';

        return $this;
    }

    public function letters(): static
    {
        $this->pattern[] = '[a-zA-Z]+';

        return $this;
    }

    public function lowerLetter(): static
    {
        $this->pattern[] = '[a-z]';

        return $this;
    }

    public function lowerLetters(): static
    {
        $this->pattern[] = '[a-z]+';

        return $this;
    }
}