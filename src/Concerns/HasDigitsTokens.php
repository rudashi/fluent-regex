<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

use Rudashi\FluentBuilder;

/**
 * @property static $number Adds a number
 * @property static $numbers Adds a numbers
 * @property static $digit Adds a digit token
 * @property static $digits Adds a digits token
 * @property static $nonDigit Adds a non-digit token
 * @property static $nonDigits Adds a non-digits token
 */
trait HasDigitsTokens
{
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
    public function numbers(int $min = 0, int $max = 9): FluentBuilder
    {
        return $this->number($min, $max)->oneOrMore();
    }

    /**
     * Adds a digit token.
     * Equivalent to `[0-9]`.
     */
    public function digit(): FluentBuilder
    {
        return $this->pushToPattern('\d');
    }

    /**
     * Adds a digits token.
     * Equivalent to `[0-9]+`.
     */
    public function digits(): FluentBuilder
    {
        return $this->pushToPattern('\d+');
    }

    /**
     * Adds a non-digit token.
     * Matches anything other than a digit.
     */
    public function nonDigit(): FluentBuilder
    {
        return $this->pushToPattern('\D');
    }

    /**
     * Adds a non-digits token.
     * Matches anything other than a digits.
     */
    public function nonDigits(): FluentBuilder
    {
        return $this->pushToPattern('\D+');
    }
}
