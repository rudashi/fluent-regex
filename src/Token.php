<?php

declare(strict_types=1);

namespace Rudashi;

use Rudashi\Contracts\TokenContract;
use Rudashi\Tokens\Letter;
use Rudashi\Tokens\Number;

final class Token
{
    public function __construct(
        private readonly FluentBuilder $builder,
        private readonly bool $sub = false,
    ) {
    }

    public function letter(string $first = 'a', string $last = 'z'): FluentBuilder
    {
        return $this->addToken(Letter::for($first, $last));
    }

    public function lowerLetter(string $first = 'a', string $last = 'z'): FluentBuilder
    {
        return $this->addToken(Letter::lower($first, $last));
    }

    public function number(int $min = 0, int $max = 9): FluentBuilder
    {
        return $this->addToken(Number::for($min, $max));
    }

    private function addToken(TokenContract $token): FluentBuilder
    {
        return $this->sub
            ? $this->builder->character($token->getToken())
            : $this->builder->anyOf($token->getToken());
    }
}
