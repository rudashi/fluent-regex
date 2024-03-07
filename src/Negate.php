<?php

declare(strict_types=1);

namespace Rudashi;

use LogicException;

/**
 * @mixin \Rudashi\FluentBuilder
 */
class Negate
{
    public function __construct(
        private FluentBuilder $builder,
    ) {
    }

    public function letter(): FluentBuilder
    {
        $this->builder->pushToPattern('[^a-zA-Z]');

        return $this->builder;
    }

    /**
     * @param  string  $method
     * @param  array<int|string, mixed>  $arguments
     * @return \Rudashi\FluentBuilder
     */
    public function __call(string $method, array $arguments): FluentBuilder
    {
        $this->builder->pushToPattern('[^');

        $result = $this->builder->{$method}($arguments);

        if ($result instanceof FluentBuilder) {
            $this->builder->pushToPattern(']');

            return $this->builder;
        }

        throw new LogicException(sprintf(
            'Method "%s" is not extendable by "Negation".',
            $method
        ));
    }
}
