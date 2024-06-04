<?php

declare(strict_types=1);

namespace Rudashi;

use LogicException;

/**
 * @mixin \Rudashi\FluentBuilder
 */
class Negate
{
    /**
     * The methods that cannot be negated.
     *
     * @var array<int, string>
     */
    public static array $guardedMethods = [
        // FluentBuilder
        'check',
        'match',
        'setContext',
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
     *
     * @param  \Rudashi\FluentBuilder  $builder
     */
    public function __construct(
        private readonly FluentBuilder $builder,
    ) {
    }

    /**
     * Dynamically calls methods on the class or creates a new higher order fluent builder.
     *
     * @param  string  $method
     * @param  array<int|string, string|int|callable>  $arguments
     *
     * @return \Rudashi\FluentBuilder
     */
    public function __call(string $method, array $arguments): FluentBuilder
    {
        if (in_array($method, static::$guardedMethods, true)) {
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
     *
     * @param  string|int|callable  $value
     *
     * @return \Rudashi\FluentBuilder
     */
    public function anyOf(string|int|callable $value): FluentBuilder
    {
        if (is_callable($value)) {
            $this->pushToPattern($value(new FluentBuilder(patterns: [], isSub: true))->get());

            return $this->builder;
        }

        $this->builder->pushToPattern('[^' . FluentBuilder::sanitize($value) . ']');

        return $this->builder;
    }

    /**
     * Adds a non-capturing group to the pattern array
     *
     * @param  callable  $callback
     * @param  bool  $lookbehind
     * @param  bool  $lookahead
     *
     * @return \Rudashi\FluentBuilder
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
     * @param  callable  $callback
     * @param  bool  $lookbehind
     * @param  bool  $lookahead
     *
     * @return \Rudashi\FluentBuilder
     */
    public function group(callable $callback, bool $lookbehind = false, bool $lookahead = false): FluentBuilder
    {
        return $this->capture($callback, $lookbehind, $lookahead);
    }

    /**
     * Adds a match to anything other than letter.
     *
     * @return \Rudashi\FluentBuilder
     */
    public function letter(): FluentBuilder
    {
        $this->builder->pushToPattern('[^a-zA-Z]');

        return $this->builder;
    }

    /**
     * Adds a match to anything other than lower letter.
     *
     * @return \Rudashi\FluentBuilder
     */
    public function lowerLetter(): FluentBuilder
    {
        $this->builder->pushToPattern('[^a-z]');

        return $this->builder;
    }

    /**
     * Adds a match to anything other than number.
     *
     * @return \Rudashi\FluentBuilder
     */
    public function number(): FluentBuilder
    {
        $this->builder->pushToPattern('[^0-9]');

        return $this->builder;
    }

    /**
     * Adds a match to anything other than numbers.
     *
     * @return \Rudashi\FluentBuilder
     */
    public function numbers(): FluentBuilder
    {
        $this->builder->pushToPattern('[^0-9]+');

        return $this->builder;
    }

    /**
     * Throws a logical exception when a method is unavailable.
     *
     * @param  string  $method
     *
     * @return never
     *
     * @throws \BadMethodCallException
     */
    protected function throwNegationException(string $method): never
    {
        throw new LogicException(sprintf(
            'Method "%s" is not extendable by "Negation".',
            $method
        ));
    }
}
