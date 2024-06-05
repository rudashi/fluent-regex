<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

use Rudashi\FluentBuilder;
use Rudashi\Tokens;

trait HasTokens
{
    /**
     * Adds a character.
     */
    public function character(string|int $value): FluentBuilder
    {
        $this->pushToPattern((string) $value);

        return $this;
    }

    /**
     * Alias for the `character` method.
     */
    public function and(string|int $value): FluentBuilder
    {
        return $this->character($value);
    }

    /**
     * Alias for the `character` method.
     */
    public function raw(string|int $value): FluentBuilder
    {
        return $this->character($value);
    }

    /**
     * Adds sanitized string to the pattern.
     */
    public function exactly(string|int $value): FluentBuilder
    {
        $this->pushToPattern(static::sanitize($value));

        return $this;
    }

    /**
     * Alias for the safety `exactly` method.
     */
    public function find(string|int $value): FluentBuilder
    {
        return $this->exactly($value);
    }

    /**
     * Alias for the safety `exactly` method.
     */
    public function then(string|int $value): FluentBuilder
    {
        return $this->exactly($value);
    }

    /**
     * Adds a letter.
     * Matches any character, ignoring case, between a and z.
     */
    public function letter(string $first = 'a', string $last = 'z'): FluentBuilder
    {
        return $this->addToken()->letter($first, $last);
    }

    /**
     * Adds a lowercase letter.
     * Matches any character between a and z.
     */
    public function lowerLetter(string $first = 'a', string $last = 'z'): FluentBuilder
    {
        return $this->addToken()->lowerLetter($first, $last);
    }

    /**
     * Adds a number.
     * Matches any character between 0 and 9.
     */
    public function number(int $min = 0, int $max = 9): FluentBuilder
    {
        return $this->addToken()->number($min, $max);
    }

    /**
     * Adds a numbers.
     */
    public function numbers(): FluentBuilder
    {
        $this->pushToPattern('[0-9]+');

        return $this;
    }

    /**
     * Adds a whitespace token.
     */
    public function whitespace(): FluentBuilder
    {
        $this->pushToPattern('\s');

        return $this;
    }

    /**
     * Adds a non-whitespace token.
     */
    public function nonWhitespace(): FluentBuilder
    {
        $this->pushToPattern('\S');

        return $this;
    }

    /**
     * Adds a digit token.
     * Equivalent to `[0-9]`.
     */
    public function digit(): FluentBuilder
    {
        $this->pushToPattern('\d');

        return $this;
    }

    /**
     * Adds a digits token.
     * Equivalent to `[0-9]+`.
     */
    public function digits(): FluentBuilder
    {
        $this->pushToPattern('\d+');

        return $this;
    }

    /**
     * Adds a non-digit token.
     * Matches anything other than a digit.
     */
    public function nonDigit(): FluentBuilder
    {
        $this->pushToPattern('\D');

        return $this;
    }

    /**
     * Adds a non-digits token.
     * Matches anything other than a digits.
     */
    public function nonDigits(): FluentBuilder
    {
        $this->pushToPattern('\D+');

        return $this;
    }

    /**
     * Adds a word character token.
     * Equivalent to `[a-zA-Z0-9_]`.
     */
    public function word(): FluentBuilder
    {
        $this->pushToPattern('\w');

        return $this;
    }

    /**
     * Adds a word characters token.
     * Equivalent to `[a-zA-Z0-9_]+`.
     */
    public function words(): FluentBuilder
    {
        $this->pushToPattern('\w+');

        return $this;
    }

    /**
     * Match any of the listed characters or tokens.
     */
    public function anyOf(string|int|callable $value): FluentBuilder
    {
        if (is_callable($value)) {
            $this->pushToPattern('[' . $value(new static(patterns: [], isSub: true))->get() . ']');

            return $this;
        }

        $this->pushToPattern('[' . addcslashes((string) $value, '/') . ']');

        return $this;
    }

    /**
     * Adds a tab token.
     */
    public function tab(): FluentBuilder
    {
        $this->pushToPattern('\t');

        return $this;
    }

    /**
     * Adds a carriage return token.
     */
    public function carriageReturn(): FluentBuilder
    {
        $this->pushToPattern('\r');

        return $this;
    }

    /**
     * Adds a newline token.
     */
    public function newline(): FluentBuilder
    {
        $this->pushToPattern('\n');

        return $this;
    }

    /**
     * Adds a line break token.
     */
    public function linebreak(): FluentBuilder
    {
        $this->carriageReturn()->or->newline();

        return $this;
    }

    /**
     * Adds a word boundary token.
     */
    public function boundary(): FluentBuilder
    {
        $this->pushToPattern('\b');

        return $this;
    }

    /**
     * Adds a non-word boundary token.
     */
    public function nonBoundary(): FluentBuilder
    {
        $this->pushToPattern('\B');

        return $this;
    }

    /**
     * Adds a token to the pattern.
     */
    private function addToken(): Tokens
    {
        return new Tokens($this, $this->isSub);
    }
}
