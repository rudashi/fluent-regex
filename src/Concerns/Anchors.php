<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

trait Anchors
{
    public function start(): static
    {
        $this->prefix[] = '^';

        return $this;
    }

    public function startOfLine(): static
    {
        return $this->start();
    }

    public function end(): static
    {
        $this->suffix[] = '$';

        return $this;
    }

    public function endOfLine(): static
    {
        return $this->end();
    }
}
