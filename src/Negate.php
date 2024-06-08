<?php

declare(strict_types=1);

namespace Rudashi;

use LogicException;

/**
 * @mixin \Rudashi\FluentBuilder
 */
final class Negate
{
    /**
     * The methods that cannot be negated.
     *
     * @var array<int, string>
     */
    private static array $guardedMethods = [
        // FluentBuilder
        'check',
        'match',
        'addContext',
        'oneOf',
        'or',
        'anything',

        // Anchors
        'start',
        'startOfLine',
        'end',
        'endOfLine',

        // Flags
        'ignoreCase',
        'multiline',
        'matchNewLine',
        'ignoreWhitespace',
        'utf8',

        // Quantifiers
        'zeroOrOne',
        'zeroOrMore',
        'oneOrMore',
        'times',
        'min',
        'between',
    ];

    /**
     * Creates a new negation of the token.
     */
    public function __construct(
        private readonly FluentBuilder $builder,
    ) {
    }

    /**
     * Dynamically calls methods on the class or creates a new higher order fluent builder.
     *
     * @param  array<int|string, string|int|callable>  $arguments
     */
    public function __call(string $method, array $arguments): FluentBuilder
    {
        if (in_array($method, self::$guardedMethods, true)) {
            $this->throwNegationException($method);
        }

        $this->builder->pushToPattern('[^');

        $result = $this->builder->{$method}(...$arguments);

        if ($result instanceof FluentBuilder) {
            $this->builder->pushToPattern(']');

            return $this->builder;
        }

        $this->throwNegationException($method);
    }

    /**
     * Match anything other than the listed characters or tokens.
     */
    public function anyOf(string|int|callable $value): FluentBuilder
    {
        if (is_callable($value)) {
            $this->pushToPattern($value(new FluentBuilder(patterns: [], isSub: true))->get());

            return $this->builder;
        }

        $this->builder->pushToPattern('[^' . addcslashes((string) $value, '/') . ']');

        return $this->builder;
    }

    /**
     * Adds a non-capturing group to the pattern array
     *
     * @param  callable(\Rudashi\FluentBuilder): \Rudashi\FluentBuilder  $callback
     */
    public function capture(callable $callback, bool $lookbehind = false, bool $lookahead = false): FluentBuilder
    {
        if ($lookbehind && $lookahead) {
            throw new LogicException('Unable to look behind and ahead at the same time.');
        }

        $behind = $lookbehind ? '?<!' : '';
        $ahead = $lookahead ? '?!' : '';

        $this->builder->pushToPattern('(' . (! $behind && ! $ahead ? '?:' : '') . $behind . $ahead);

        $callback($this->builder);

        $this->builder->pushToPattern(')');

        return $this->builder;
    }

    /**
     * Adds a non-capture alternative to the pattern array.
     *
     * @param  callable(\Rudashi\FluentBuilder): \Rudashi\FluentBuilder  $callback
     */
    public function group(callable $callback, bool $lookbehind = false, bool $lookahead = false): FluentBuilder
    {
        return $this->capture($callback, $lookbehind, $lookahead);
    }

    /**
     * Adds a match to anything other than letter.
     */
    public function letter(): FluentBuilder
    {
        $this->builder->pushToPattern('[^a-zA-Z]');

        return $this->builder;
    }

    /**
     * Adds a match to anything other than lower letter.
     */
    public function lowerLetter(): FluentBuilder
    {
        $this->builder->pushToPattern('[^a-z]');

        return $this->builder;
    }

    /**
     * Adds a match to anything other than number.
     */
    public function number(): FluentBuilder
    {
        $this->builder->pushToPattern('[^0-9]');

        return $this->builder;
    }

    /**
     * Adds a match to anything other than numbers.
     */
    public function numbers(): FluentBuilder
    {
        $this->builder->pushToPattern('[^0-9]+');

        return $this->builder;
    }

    /**
     * Throws a logical exception when a method is unavailable.
     *
     * @throws \BadMethodCallException
     */
    private function throwNegationException(string $method): never
    {
        throw new LogicException(sprintf(
            'Method "%s" is not extendable by "Negation".',
            $method
        ));
    }
}
