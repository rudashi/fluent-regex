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
        'start',
        'startOfLine',
        'end',
        'endOfLine',
        'oneOf',
        'or',
        'ignoreCase',
        'multiline',
        'matchNewLine',
        'ignoreWhitespace',
        'utf8',
    ];

    public function __construct(
        private readonly FluentBuilder $builder,
    ) {
    }

    public function anyOf(string $value): FluentBuilder
    {
        $this->builder->pushToPattern('[^' . FluentBuilder::sanitize($value) . ']');

        return $this->builder;
    }

    public function letter(): FluentBuilder
    {
        $this->builder->pushToPattern('[^a-zA-Z]');

        return $this->builder;
    }

    public function letters(): FluentBuilder
    {
        $this->builder->pushToPattern('[^a-zA-Z]+');

        return $this->builder;
    }

    public function lowerLetter(): FluentBuilder
    {
        $this->builder->pushToPattern('[^a-z]');

        return $this->builder;
    }

    public function lowerLetters(): FluentBuilder
    {
        $this->builder->pushToPattern('[^a-z]+');

        return $this->builder;
    }

    /**
     * @param  string  $method
     * @param  array<int|string, mixed>  $arguments
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

    protected function throwNegationException(string $method): never
    {
        throw new LogicException(sprintf(
            'Method "%s" is not extendable by "Negation".',
            $method
        ));
    }
}
