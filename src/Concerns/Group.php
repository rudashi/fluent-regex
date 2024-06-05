<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

use LogicException;
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
        if ($lookbehind && $lookahead) {
            throw new LogicException('Unable to look behind and ahead at the same time.');
        }

        $behind = $lookbehind ? '?<=' : '';
        $ahead = $lookahead ? '?=' : '';

        $this->pushToPattern('(' . $behind . $ahead);

        $callback($this);

        $this->pushToPattern(')');

        return $this;
    }

    /**
     * Adds a capture alternative to the pattern array.
     *
     * @param  callable(\Rudashi\FluentBuilder):\Rudashi\FluentBuilder  $callback
     */
    public function group(callable $callback): FluentBuilder
    {
        return $this->capture($callback);
    }

    /**
     * Adds optional captures to the pattern array.
     *
     * @param  callable(\Rudashi\FluentBuilder):\Rudashi\FluentBuilder|string|int  $callback
     */
    public function maybe(callable|string|int $callback): FluentBuilder
    {
        if (is_callable($callback)) {
            return $this->capture($callback)->zeroOrOne();
        }

        return $this->character($callback)->zeroOrOne();
    }
}
