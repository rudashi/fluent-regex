<?php

declare(strict_types=1);

namespace Rudashi;

use LogicException;
use Rudashi\Tokens\Group;

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
        'get',
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

        return $this->builder->anyOf(static fn (FluentBuilder $fluent) => $fluent->raw('^')->{$method}(...$arguments));
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

        return $this->builder->pushToPattern('[^' . addcslashes((string) $value, '/') . ']');
    }

    /**
     * Adds a non-capturing group to the pattern array
     *
     * @param  callable(\Rudashi\FluentBuilder): \Rudashi\FluentBuilder  $callback
     */
    public function capture(callable $callback, bool $lookbehind = false, bool $lookahead = false): FluentBuilder
    {
        return $this->builder->addToken()->capture($callback, Group::make($lookbehind, $lookahead, true));
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
     * Adds optional captures to the pattern array.
     *
     * @param  callable(\Rudashi\FluentBuilder): \Rudashi\FluentBuilder|string|int  $callback
     */
    public function maybe(callable|string|int $callback): FluentBuilder
    {
        return (is_callable($callback) ? $this->capture($callback) : $this->builder->character($callback))->zeroOrOne();
    }

    /**
     * Adds a match to anything other than numbers.
     */
    public function numbers(): FluentBuilder
    {
        return $this->number()->oneOrMore();
    }

    /**
     * Throws a logical exception when a method is unavailable.
     *
     * @throws \BadMethodCallException
     */
    private function throwNegationException(string $method): never
    {
        throw new LogicException(sprintf('Method "%s" is not extendable by "Negation".', $method));
    }
}
