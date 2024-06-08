<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

use Rudashi\FluentBuilder;

trait HasGeneralTokens
{
    /**
     * Adds a tab token.
     */
    public function tab(): FluentBuilder
    {
        $this->pushToPattern('\t');

        return $this;
    }

    /**
     * Adds a carriage return token.
     */
    public function carriageReturn(): FluentBuilder
    {
        $this->pushToPattern('\r');

        return $this;
    }

    /**
     * Adds a newline token.
     */
    public function newline(): FluentBuilder
    {
        $this->pushToPattern('\n');

        return $this;
    }

    /**
     * Adds a line break token.
     */
    public function linebreak(): FluentBuilder
    {
        $this->carriageReturn()->or->newline();

        return $this;
    }
}
