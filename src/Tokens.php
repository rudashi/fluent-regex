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

    public function letter(string $first = 'a', string $last = 'z'): FluentBuilder
    {
        $lowerFirst = strtolower($first);
        $lowerLast = strtolower($last);

        $this->checkLetters($lowerFirst, $lowerLast);

        return $this->addToken($lowerFirst . '-' . $lowerLast . strtoupper($first) . '-' . strtoupper($last));
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

    public function lowerLetter(string $first = 'a', string $last = 'z'): FluentBuilder
    {
        $first = strtolower($first);
        $last = strtolower($last);

        $this->checkLetters($first, $last);

        return $this->addToken($first . '-' . $last);
    }

    protected function throwLogicException(string $message): never
    {
        throw new LogicException($message);
    }

    protected function checkLetters(string $first, string $last): void
    {
        if (!in_array($first, range('a', 'y'), true)) {
            $this->throwLogicException('The first letter must be between [a-y].');
        }

        if (!in_array($last, range('b', 'z'), true)) {
            $this->throwLogicException('The last letter must be between [b-z].');
        }
    }

    private function addToken(string $token): FluentBuilder
    {
        $this->builder->pushToPattern($this->sub ? $token : '[' . $token . ']');

        return $this->builder;
    }
}
