<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

trait Returnable
{
    /**
     * Get the full regular expression pattern.
     */
    public function get(): string
    {
        if ($this->isSub) {
            return implode('', $this->pattern);
        }

        return implode('', [
            ...$this->anchors->getPrefix(),
            ...$this->pattern,
            ...$this->anchors->getSuffix(),
            ...$this->modifiers,
        ]);
    }

    /**
     * Determines whether the context matches a given pattern.
     */
    public function check(): bool
    {
        if (implode('', $this->pattern) === '') {
            return false;
        }

        return preg_match($this->get(), $this->context) > 0;
    }

    /**
     * Returns an array of strings matching the given pattern.
     *
     * @return array<int, string>
     */
    public function match(): array
    {
        preg_match_all($this->get(), $this->context, $matches);

        return $matches[0] ?? [];
    }
}
