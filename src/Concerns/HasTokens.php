<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

use Rudashi\Tokens;

trait HasTokens
{
    public function character(string|int $value): static
    {
        $this->pushToPattern((string) $value);

        return $this;
    }

    public function and(string|int $value): static
    {
        return $this->character($value);
    }

    public function exactly(string|int $value): static
    {
        $this->pushToPattern(static::sanitize($value));

        return $this;
    }

    public function find(string|int $value): static
    {
        return $this->exactly($value);
    }

    public function then(string|int $value): static
    {
        return $this->exactly($value);
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

    public function number(): static
    {
        $this->pushToPattern('[0-9]');

        return $this;
    }

    public function numbers(): static
    {
        $this->pushToPattern('[0-9]+');

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

    public function nonDigit(): static
    {
        $this->pushToPattern('\D');

        return $this;
    }

    public function nonDigits(): static
    {
        $this->pushToPattern('\D+');

        return $this;
    }

    public function word(): static
    {
        $this->pushToPattern('\w');

        return $this;
    }

    public function words(): static
    {
        $this->pushToPattern('\w+');

        return $this;
    }

    public function anyOf(string|int|callable $value): static
    {
        if (is_callable($value)) {
            $this->pushToPattern('[' . $value(new static(patterns: [], isSub: true))->get() . ']');

            return $this;
        }

        $this->pushToPattern('[' . static::sanitize($value) . ']');

        return $this;
    }

    public function tab(): static
    {
        $this->pushToPattern('\t');

        return $this;
    }

    public function carriageReturn(): static
    {
        $this->pushToPattern('\r');

        return $this;
    }

    public function newline(): static
    {
        $this->pushToPattern('\n');

        return $this;
    }

    public function linebreak(): static
    {
        $this->carriageReturn()->or->newline();

        return $this;
    }

    /**
     * Adds a token to the pattern.
     *
     * @return \Rudashi\Tokens
     */
    private function addToken(): Tokens
    {
        return new Tokens($this, $this->isSub);
    }
}
