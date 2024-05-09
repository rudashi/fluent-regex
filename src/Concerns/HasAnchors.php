<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

use Rudashi\FluentBuilder;

trait HasAnchors
{
    /**
     * Adds the beginning of a string anchor.
     * If multiline mode is used, this will also work after a newline character.
     *
     * @return \Rudashi\FluentBuilder
     */
    public function start(): FluentBuilder
    {
        return $this->anchors->start();
    }

    /**
     * Alias for the `start` method.
     *
     * @return \Rudashi\FluentBuilder
     */
    public function startOfLine(): FluentBuilder
    {
        return $this->start();
    }

    /**
     * Adds the end of a string anchor.
     * If multiline mode is used, this will also work before a newline character.
     *
     * @return \Rudashi\FluentBuilder
     */
    public function end(): FluentBuilder
    {
        return $this->anchors->end();
    }

    /**
     * Alias for the `end` method.
     *
     * @return \Rudashi\FluentBuilder
     */
    public function endOfLine(): FluentBuilder
    {
        return $this->end();
    }
}
