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
     * @param  \Rudashi\FluentBuilder  $builder
     * @param  array<int, string>  $excluded
     */
    public function __construct(
        private readonly FluentBuilder $builder,
        private readonly array $excluded = [],
    ) {
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
        if (in_array($method, $this->excluded, true)) {
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
