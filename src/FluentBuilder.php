<?php

declare(strict_types=1);

namespace Rudashi;

use ArgumentCountError;
use BadMethodCallException;
use InvalidArgumentException;
use LogicException;
use Rudashi\Concerns\HasAnchors;
use Rudashi\Concerns\Dumpable;
use Rudashi\Concerns\Flags;
use Rudashi\Concerns\Quantifiers;
use Rudashi\Concerns\HasTokens;
use Rudashi\Contracts\PatternContract;

/**
 * @property Negate $not Creates the negative pattern
 * @property static $or Adds alternative
 */
class FluentBuilder
{
    use HasAnchors;
    use HasTokens;
    use Flags;
    use Dumpable;
    use Quantifiers;

    protected const DELIMITER = '/';

    protected string $context = '';

    /**
     * @var array<int, PatternContract>
     */
    protected array $patterns = [];

    /**
     * @var array<int, string>
     */
    protected array $pattern = [];

    /**
     * @var array<int, string>
     */
    protected array $modifiers = [];

    protected Anchors $anchors;

    /**
     * @param  array<int, class-string<PatternContract>>  $patterns
     */
    public function __construct(array $patterns = []) {
        $this->anchors = new Anchors(
            builder: $this,
            delimiter: self::DELIMITER
        );
        $this->registerPatterns($patterns);
    }

    public static function sanitize(string|int $value): string
    {
        $value = (string) $value;

        return $value !== '' ? preg_quote($value, '/') : $value;
    }

    public function get(): string
    {
        return implode('', [
            ...$this->anchors->getPrefix(),
            ...$this->pattern,
            ...$this->anchors->getSuffix(),
            ...$this->modifiers,
        ]);
    }

    public function check(): bool
    {
        if (implode('', $this->pattern) === '') {
            return false;
        }

        return preg_match($this->get(), $this->context) > 0;
    }

    /**
     * @return array<int, string>
     */
    public function match(): array
    {
        preg_match_all($this->get(), $this->context, $matches);

        return $matches[0] ?? [];
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

    public function capture(callable $callback): static
    {
        $this->pushToPattern('(');

        $callback($this);

        $this->pushToPattern(')');

        return $this;
    }

    public function maybe(callable $callback): static
    {
        return $this->capture($callback)->zeroOrOne();
    }

    public function not(): Negate
    {
        return new Negate(
            builder: $this,
        );
    }

    public function oneOf(string ...$value): static
    {
        $this->pushToPattern(
            implode('|', array_map([$this, 'sanitize'], $value))
        );

        return $this;
    }

    public function or(): static
    {
        $this->pushToPattern('|');

        return $this;
    }

    public function anything(): static
    {
        $this->pushToPattern('.*');

        return $this;
    }

    public function __get(string $name): mixed
    {
        if (method_exists($this, $name) === false) {
            $this->throwBadMethodException('Method "%s" does not exist in %s.', $name, __CLASS__);
        }

        try {
            return $this->{$name}();
        } catch (ArgumentCountError) {
            $this->throwBadMethodException('Cannot access property "%s". Use the "%s()" method instead.', $name, $name);
        }
    }

    /**
     * @param  string  $name
     * @param  array<int, mixed>  $arguments
     * @return static
     */
    public function __call(string $name, array $arguments): static
    {
        foreach ($this->patterns as $pattern) {
            if ($pattern->getName() === $name) {
                $this->pushToPattern($pattern->getPattern());

                return $this;
            }
        }

        $this->throwBadMethodException('Method "%s" does not exist in %s.', $name, __CLASS__);
    }

    public function __set(string $name, mixed $value): void
    {
        throw new LogicException(sprintf('Setter "%s" is not acceptable.', $name));
    }

    protected function throwBadMethodException(string $format, string|int ...$values): void
    {
        throw new BadMethodCallException(sprintf($format, ...$values));
    }

    /**
     * @param  array<int, class-string<PatternContract>>  $patterns
     * @return static
     */
    private function registerPatterns(array $patterns): static
    {
        foreach ($patterns as $pattern) {
            if (!is_subclass_of($pattern, PatternContract::class)) {
                throw new InvalidArgumentException(
                    sprintf('Class "%s" must implement PatternContract.', $pattern)
                );
            }

            $this->patterns[] = new $pattern();
        }

        return $this;
    }
}
