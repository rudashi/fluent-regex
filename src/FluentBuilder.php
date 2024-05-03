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

    /**
     * Regex delimiter value
     *
     * @var string
     */
    protected const DELIMITER = '/';

    /**
     * The underlying string value.
     *
     * @var string
     */
    protected string $context = '';

    /**
     * The registered patterns.
     *
     * @var array<int, PatternContract>
     */
    protected array $patterns = [];

    /**
     * The pattern stack.
     *
     * @var array<int, string>
     */
    protected array $pattern = [];

    /**
     * All assigned modifiers.
     *
     * @var array<int, string>
     */
    protected array $modifiers = [];

    /**
     * The Anchors instance.
     *
     * @var \Rudashi\Anchors
     */
    protected Anchors $anchors;

    /**
     * Create a new instance of the class.
     *
     * @param  array<int, class-string<\Rudashi\Contracts\PatternContract>>  $patterns
     * @param  bool  $isSub
     */
    public function __construct(
        array $patterns = [],
        private readonly bool $isSub = false,
    ) {
        $this->anchors = new Anchors(
            builder: $this,
            delimiter: self::DELIMITER
        );
        $this->registerPatterns($patterns);
    }

    /**
     * Sanitize the given expression value.
     *
     * @param  string|int  $value
     * @return string
     */
    public static function sanitize(string|int $value): string
    {
        $value = (string) $value;

        return $value !== '' ? preg_quote($value, '/') : $value;
    }

    /**
     * Get the full regular expression pattern.
     *
     * @return string
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
     * Determines whether the context matches a given pattern..
     *
     * @return bool
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

    /**
     * Adds a new value to the pattern array.
     *
     * @param  string  $value
     * @return $this
     */
    public function pushToPattern(string $value): static
    {
        $this->pattern[] = $value;

        return $this;
    }

    /**
     * Sets the context to the builder instance.
     *
     * @param  string  $string
     * @return $this
     */
    public function setContext(string $string): static
    {
        if ($this->isSub) {
            throw new LogicException(
                sprintf('Method "%s" is not acceptable in sub patterns.', __FUNCTION__)
            );
        }

        $this->context = $string;

        return $this;
    }

    /**
     * Adds a capture to the pattern array.
     *
     * @param  callable  $callback
     * @return $this
     */
    public function capture(callable $callback): static
    {
        $this->pushToPattern('(');

        $callback($this);

        $this->pushToPattern(')');

        return $this;
    }

    /**
     * Adds a capture alternative to the pattern array.
     *
     * @param  callable  $callback
     * @return $this
     */
    public function group(callable $callback): static
    {
        return $this->capture($callback);
    }

    /**
     * Adds optional captures to the pattern array.
     *
     * @param  callable  $callback
     * @return $this
     */
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

    public function pattern(string $string): static
    {
        return $this->__call($string, []);
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
            if ($pattern->getName() === $name || $pattern->alias() === $name) {
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
     * @param  array<int, class-string<\Rudashi\Contracts\PatternContract>>  $patterns
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
