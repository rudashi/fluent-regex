<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

use Rudashi\FluentBuilder;
use Rudashi\Tokens;

/**
 * @property static $letter Adds a letter
 * @property static $lowerLetter Adds a lowercase letter
 * @property static $whitespace Adds a whitespace token
 * @property static $nonWhitespace Adds a non-whitespace token
 * @property static $word Adds a word character token
 * @property static $words Adds a word characters token
 * @property static $boundary Adds a word boundary token
 * @property static $nonBoundary Adds a non-word boundary token
 */
trait HasTokens
{
    use HasGeneralTokens;
    use HasDigitsTokens;

    /**
     * Adds a character.
     */
    public function character(string|int $value): FluentBuilder
    {
        return $this->pushToPattern((string) $value);
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
        return $this->pushToPattern(static::sanitize($value));
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
     * Adds a whitespace token.
     */
    public function whitespace(): FluentBuilder
    {
        return $this->pushToPattern('\s');
    }

    /**
     * Adds a non-whitespace token.
     */
    public function nonWhitespace(): FluentBuilder
    {
        return $this->pushToPattern('\S');
    }

    /**
     * Adds a word character token.
     * Equivalent to `[a-zA-Z0-9_]`.
     */
    public function word(): FluentBuilder
    {
        return $this->pushToPattern('\w');
    }

    /**
     * Adds a word characters token.
     * Equivalent to `[a-zA-Z0-9_]+`.
     */
    public function words(): FluentBuilder
    {
        return $this->pushToPattern('\w+');
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
     * Adds a word boundary token.
     */
    public function boundary(): FluentBuilder
    {
        return $this->pushToPattern('\b');
    }

    /**
     * Adds a non-word boundary token.
     */
    public function nonBoundary(): FluentBuilder
    {
        return $this->pushToPattern('\B');
    }

    /**
     * Adds optional captures to the pattern array.
     *
     * @param  callable(\Rudashi\FluentBuilder):\Rudashi\FluentBuilder|string|int  $callback
     */
    public function maybe(callable|string|int $callback): FluentBuilder
    {
        is_callable($callback) ? $this->capture($callback) : $this->character($callback);

        return $this->zeroOrOne();
    }

    /**
     * Adds a token to the pattern.
     */
    private function addToken(): Tokens
    {
        return new Tokens($this, $this->isSub);
    }
}
