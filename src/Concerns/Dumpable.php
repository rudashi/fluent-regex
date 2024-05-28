<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

trait Dumpable
{
    /**
     * Dump the given arguments.
     *
     * @param  mixed  ...$arguments
     * @return $this
     */
    public function dump(mixed ...$arguments): static
    {
        function_exists('dump') ? dump($this, ...$arguments) : var_dump($this);

        return $this;
    }

    /**
     * Dump the given arguments and terminate execution.
     *
     * @param  mixed  ...$arguments
     * @return void
     */
    public function dd(mixed ...$arguments): void
    {
        if (function_exists('dd')) {
            dd($this, ...$arguments);
        }

        var_dump($this);

        exit(1);
    }
}
