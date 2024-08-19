<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

use Closure;
use Rudashi\FluentBuilder;

trait Group
{
    /**
     * Adds a capture to the pattern array.
     *
     * @param  \Closure(\Rudashi\FluentBuilder):\Rudashi\FluentBuilder  $callback
     */
    public function capture(Closure $callback, bool $lookbehind = false, bool $lookahead = false): FluentBuilder
    {
        return $this->addToken()->capture($callback, \Rudashi\Tokens\Group::make($lookbehind, $lookahead));
    }

    /**
     * Adds a capture alternative to the pattern array.
     *
     * @param  \Closure(\Rudashi\FluentBuilder):\Rudashi\FluentBuilder  $callback
     */
    public function group(Closure $callback, bool $lookbehind = false, bool $lookahead = false): FluentBuilder
    {
        return $this->capture($callback, $lookbehind, $lookahead);
    }
}
