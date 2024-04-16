<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

use Rudashi\Flag;

trait Flags
{
    public function ignoreCase(): static
    {
        return $this->addFlag(Flag::INSENSITIVE);
    }

    public function multiline(): static
    {
        return $this->addFlag(Flag::MULTI_LINE);
    }

    public function matchNewLine(): static
    {
        return $this->addFlag(Flag::SINGLE_LINE);
    }

    public function ignoreWhitespace(): static
    {
        return $this->addFlag(Flag::EXTENDED);
    }

    public function utf8(): static
    {
        return $this->addFlag(Flag::UNICODE);
    }

    public function unicode(): static
    {
        return $this->utf8();
    }

    private function addFlag(Flag $flag): static
    {
        if (in_array($flag->value, $this->modifiers, true) === false) {
            $this->modifiers[] = $flag->value;
        }

        return $this;
    }
}
