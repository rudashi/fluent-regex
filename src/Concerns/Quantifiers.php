<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

use LogicException;
use Rudashi\FluentBuilder;
use Rudashi\Quantifier;

/**
 * @property static $zeroOrOne Adds a quantifier that matches once or never
 * @property static $zeroOrMore Adds a quantifier that matches an infinitely many times or not at all
 * @property static $oneOrMore Adds a quantifier that matches once or infinitely many times
 */
trait Quantifiers
{
    /**
     * Adds a quantifier that matches once or never.
     */
    public function zeroOrOne(): FluentBuilder
    {
        $this->pushToPattern(Quantifier::ZERO_OR_ONE);

        return $this;
    }

    /**
     * Adds a quantifier that matches an infinitely many times or not at all.
     */
    public function zeroOrMore(): FluentBuilder
    {
        $this->pushToPattern(Quantifier::ZERO_OR_MORE);

        return $this;
    }

    /**
     * Adds a quantifier that matches once or infinitely many times.
     */
    public function oneOrMore(): FluentBuilder
    {
        $this->pushToPattern(Quantifier::ONE_OR_MORE);

        return $this;
    }

    /**
     * Adds a quantifier that matches the given value times.
     */
    public function times(int $number): FluentBuilder
    {
        if ($number < 0) {
            $this->throwNegativeIntegerException('number');
        }

        $this->pushToPattern('{' . $number . '}');

        return $this;
    }

    /**
     * Adds a quantifier that matches a minimum of times.
     */
    public function min(int $number): FluentBuilder
    {
        if ($number < 0) {
            $this->throwNegativeIntegerException('number');
        }

        $this->between($number);

        return $this;
    }

    /**
     * Adds a quantifier that matches between two given values.
     */
    public function between(int $min, int|null $max = null): FluentBuilder
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

    /**
     * Throws a logical exception when used negative integer.
     *
     * @throws \LogicException
     */
    private function throwNegativeIntegerException(string $parameter): void
    {
        throw new LogicException(sprintf('The "%s" parameter must be a positive integer.', $parameter));
    }
}
