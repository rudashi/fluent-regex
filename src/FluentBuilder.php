<?php

declare(strict_types=1);

namespace Rudashi;

class FluentBuilder
{
    protected string $context = '';
    /**
     * @var array<int, string>
     */
    protected array $pattern = [];
    /**
     * @var array<int, string>
     */
    protected array $prefix = ['/'];
    /**
     * @var array<int, string>
     */
    protected array $suffix = ['/'];
    /**
     * @var array<int, string>
     */
    protected array $modifiers = [];

    public function get(): string
    {
        return implode('', [...$this->prefix, ...$this->pattern, ...$this->suffix, ...$this->modifiers]);
    }

    public function setContext(string $string): static
    {
        $this->context = $string;

        return $this;
    }
}
