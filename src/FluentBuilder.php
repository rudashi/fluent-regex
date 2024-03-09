<?php

declare(strict_types=1);

namespace Rudashi;

use BadMethodCallException;
use LogicException;
use Rudashi\Concerns\Anchors;
use Rudashi\Concerns\Dumpable;
use Rudashi\Concerns\Tokens;

/**
 * @property Negate $not Creates the negative pattern.
 */
class FluentBuilder
{
    use Anchors;
    use Tokens;
    use Dumpable;

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
    protected array $suffix = [];
    /**
     * @var array<int, string>
     */
    protected array $modifiers = [self::DELIMITER];

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

    public function not(): Negate
    {
        return new Negate($this);
    }

    protected function sanitize(string $value): string
    {
        return $value !== '' ? preg_quote($value, '/') : $value;
    }

    public function __get(string $name): mixed
    {
        if (method_exists($this, $name) === false) {
            throw new BadMethodCallException(sprintf(
                'Method "%s" does not exist in %s.',
                $name,
                __CLASS__,
            ));
        }

        return $this->{$name}();
    }

    public function __set(string $name, mixed $value): void
    {
        throw new LogicException(sprintf('Setter "%s" is not acceptable.', $name));
    }
}
