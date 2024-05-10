<?php

declare(strict_types=1);

namespace Rudashi;

use LogicException;

class Tokens
{
    public function __construct(
        private readonly FluentBuilder $builder,
        private readonly bool $sub = false,
    ) {
    }

    public function letter(): FluentBuilder
    {
        return $this->addToken('a-zA-Z');
    }

    public function number(int $min = 0, int $max = 9): FluentBuilder
    {
        if ($min < 0 || $min > 8) {
            $this->throwLogicException('The number range must be between [0-9].');
        }

        if ($max < 1 || $max > 9) {
            $this->throwLogicException('The number range must be between [0-9].');
        }

        return $this->addToken($min . '-' . $max);
    }

    public function lowerLetter(): FluentBuilder
    {
        return $this->addToken('a-z');
    }

    protected function throwLogicException(string $message): never
    {
        throw new LogicException($message);
    }

    private function addToken(string $token): FluentBuilder
    {
        $this->builder->pushToPattern($this->sub ? $token : '[' . $token . ']');

        return $this->builder;
    }
}
