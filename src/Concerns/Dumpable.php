<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

trait Dumpable
{
    public function dump(mixed ...$arguments): static
    {
        if (function_exists('dump')) {
            dump($this, ...$arguments);
        } else {
            var_dump($this);
        }

        return $this;
    }

    public function dd(mixed ...$arguments): void
    {
        if (function_exists('dd')) {
            dd($this, ...$arguments);
        }

        var_dump($this);

        exit(1);
    }
}
