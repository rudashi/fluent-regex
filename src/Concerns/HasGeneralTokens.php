<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

use Rudashi\FluentBuilder;

/**
 * @property static $tab Adds a tab token
 * @property static $carriageReturn Adds a carriage return token
 * @property static $newline Adds a newline token
 * @property static $linebreak Adds a line break token
 */
trait HasGeneralTokens
{
    /**
     * Adds a tab token.
     */
    public function tab(): FluentBuilder
    {
        return $this->pushToPattern('\t');
    }

    /**
     * Adds a carriage return token.
     */
    public function carriageReturn(): FluentBuilder
    {
        return $this->pushToPattern('\r');
    }

    /**
     * Adds a newline token.
     */
    public function newline(): FluentBuilder
    {
        return $this->pushToPattern('\n');
    }

    /**
     * Adds a line break token.
     */
    public function linebreak(): FluentBuilder
    {
        return $this->carriageReturn()->or->newline();
    }
}
