<?php

declare(strict_types=1);

namespace Rudashi;

use Closure;
use Rudashi\Contracts\TokenContract;
use Rudashi\Tokens\Letter;
use Rudashi\Tokens\Number;

final readonly class Token
{
    public function __construct(
        private FluentBuilder $builder,
        private bool $sub = false,
    ) {
    }

    public function capture(Closure $callback, TokenContract $group): FluentBuilder
    {
        $this->builder->pushToPattern('(' . $group->getToken());

        $callback($this->builder);

        $this->builder->pushToPattern(')');

        return $this->builder;
    }

    public function letter(string $first = 'a', string $last = 'z'): FluentBuilder
    {
        return $this->addToken(Letter::make($first, $last));
    }

    public function lowerLetter(string $first = 'a', string $last = 'z'): FluentBuilder
    {
        return $this->addToken(Letter::make($first, $last, true));
    }

    public function number(int $min = 0, int $max = 9): FluentBuilder
    {
        return $this->addToken(Number::make($min, $max));
    }

    private function addToken(TokenContract $token): FluentBuilder
    {
        return $this->sub ? $this->builder->character($token->getToken()) : $this->builder->anyOf($token->getToken());
    }
}
