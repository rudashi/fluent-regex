<?php

declare(strict_types=1);

namespace Rudashi;

class FluentBuilder
{
    protected string $context = '';

    public function setContext(string $string): static
    {
        $this->context = $string;

        return $this;
    }
}
