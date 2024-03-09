<?php

declare(strict_types=1);

namespace Rudashi;

class Regex
{
    public static function build(): FluentBuilder
    {
        return (new static())->newBuilder();
    }

    public static function for(string $string): FluentBuilder
    {
        return static::build()->setContext($string);
    }

    public static function start(): FluentBuilder
    {
        return static::build()->startOfLine();
    }

    public static function startOfLine(): FluentBuilder
    {
        return static::start();
    }

    public function newBuilder(): FluentBuilder
    {
        return new FluentBuilder();
    }
}
