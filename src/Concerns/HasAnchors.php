<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

trait HasAnchors
{
    public function start(): self
    {
        return $this->anchors->start();
    }

    public function startOfLine(): self
    {
        return $this->start();
    }

    public function end(): self
    {
        return $this->anchors->end();
    }

    public function endOfLine(): self
    {
        return $this->end();
    }
}
