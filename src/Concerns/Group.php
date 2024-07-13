<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

use Rudashi\FluentBuilder;

trait Group
{
    /**
     * Adds a capture to the pattern array.
     *
     * @param  callable(\Rudashi\FluentBuilder):\Rudashi\FluentBuilder  $callback
     */
    public function capture(callable $callback, bool $lookbehind = false, bool $lookahead = false): FluentBuilder
    {
        return $this->addToken()->capture($callback, \Rudashi\Tokens\Group::make($lookbehind, $lookahead));
    }

    /**
     * Adds a capture alternative to the pattern array.
     *
     * @param  callable(\Rudashi\FluentBuilder):\Rudashi\FluentBuilder  $callback
     */
    public function group(callable $callback, bool $lookbehind = false, bool $lookahead = false): FluentBuilder
    {
        return $this->capture($callback, $lookbehind, $lookahead);
    }
}
