<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

use BadMethodCallException;
use InvalidArgumentException;
use LogicException;

trait ThrowExceptions
{
    /**
     * Throws a bad method call exception for the given method.
     *
     * @throws \BadMethodCallException
     */
    protected function throwBadMethodException(string $method): never
    {
        throw new BadMethodCallException(sprintf('Method "%s" does not exist in %s.', $method, self::class));
    }

    /**
     * Throws a logic exception.
     *
     * @throws \LogicException
     */
    protected function throwLogicException(string $message): never
    {
        throw new LogicException($message);
    }

    /**
     * Throws an invalid argument exception.
     *
     * @throws \InvalidArgumentException
     */
    protected function throwArgumentException(string $message): never
    {
        throw new InvalidArgumentException($message);
    }
}
