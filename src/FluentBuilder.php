<?php

declare(strict_types=1);

namespace Rudashi;

use Rudashi\Concerns\Tokens;

class FluentBuilder
{
    use Tokens;

    protected const DELIMITER = '/';

    protected string $context = '';
    /**
     * @var array<int, string>
     */
    protected array $pattern = [];
    /**
     * @var array<int, string>
     */
    protected array $prefix = [self::DELIMITER];
    /**
     * @var array<int, string>
     */
    protected array $suffix = [self::DELIMITER];
    /**
     * @var array<int, string>
     */
    protected array $modifiers = [];

    public function get(): string
    {
        return implode('', [
            ...$this->prefix,
            ...$this->pattern,
            ...$this->suffix,
            ...$this->modifiers,
        ]);
    }

    public function pushToPattern(string $value): static
    {
        $this->pattern[] = $value;

        return $this;
    }

    public function setContext(string $string): static
    {
        $this->context = $string;

        return $this;
    }

    protected function sanitize(string $value): string
    {
        return $value !== '' ? preg_quote($value, '/') : $value;
    }
}
