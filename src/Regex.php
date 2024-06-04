<?php

declare(strict_types=1);

namespace Rudashi;

class Regex
{
    /**
     * @param  array<int, class-string<\Rudashi\Contracts\PatternContract>>  $patterns
     *
     * @return \Rudashi\FluentBuilder
     */
    public static function build(array $patterns = []): FluentBuilder
    {
        return (new static())->newBuilder($patterns);
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

    /**
     * @param  array<int, class-string<\Rudashi\Contracts\PatternContract>>  $patterns
     *
     * @return \Rudashi\FluentBuilder
     */
    public function newBuilder(array $patterns = []): FluentBuilder
    {
        return new FluentBuilder($patterns);
    }
}
