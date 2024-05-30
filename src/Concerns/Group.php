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
     * @param  callable  $callback
     * @param  bool  $lookbehind
     * @param  bool  $lookahead
     * @return \Rudashi\FluentBuilder
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
     * @param  callable  $callback
     * @return \Rudashi\FluentBuilder
     */
    public function group(callable $callback): FluentBuilder
    {
        return $this->capture($callback);
    }

    /**
     * Adds optional captures to the pattern array.
     *
     * @param  callable  $callback
     * @return \Rudashi\FluentBuilder
     */
    public function maybe(callable $callback): FluentBuilder
    {
        return $this->capture($callback)->zeroOrOne();
    }
}
