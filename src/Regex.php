<?php

declare(strict_types=1);

namespace Rudashi;

final class Regex
{
    /**
     * @param  array<int, class-string<\Rudashi\Contracts\PatternContract>>  $patterns
     */
    public static function build(array $patterns = []): FluentBuilder
    {
        return (new self())->newBuilder($patterns);
    }

    public static function for(string $string): FluentBuilder
    {
        return self::build()->addContext($string);
    }

    public static function start(): FluentBuilder
    {
        return self::build()->startOfLine();
    }

    public static function startOfLine(): FluentBuilder
    {
        return self::start();
    }

    /**
     * @param  array<int, class-string<\Rudashi\Contracts\PatternContract>>  $patterns
     */
    public function newBuilder(array $patterns = []): FluentBuilder
    {
        return new FluentBuilder($patterns);
    }
}
