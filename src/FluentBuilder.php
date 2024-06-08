<?php

declare(strict_types=1);

namespace Rudashi;

use ArgumentCountError;
use BackedEnum;
use BadMethodCallException;
use InvalidArgumentException;
use LogicException;
use Rudashi\Concerns\Dumpable;
use Rudashi\Concerns\Flags;
use Rudashi\Concerns\Group;
use Rudashi\Concerns\HasAnchors;
use Rudashi\Concerns\HasTokens;
use Rudashi\Concerns\Quantifiers;
use Rudashi\Concerns\Returnable;
use Rudashi\Contracts\PatternContract;

/**
 * @property Negate $not Creates the negative pattern
 * @property static $or Adds alternative
 */
final class FluentBuilder
{
    use HasAnchors;
    use HasTokens;
    use Flags;
    use Dumpable;
    use Quantifiers;
    use Group;
    use Returnable;

    /**
     * Regex delimiter value.
     */
    protected const DELIMITER = '/';

    /**
     * The underlying string value.
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
     */
    protected Anchors $anchors;

    /**
     * Create a new instance of the class.
     *
     * @param  array<int, class-string<\Rudashi\Contracts\PatternContract>>  $patterns
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
     * Dynamically access builder proxies.
     *
     * @throws \LogicException
     * @throws \BadMethodCallException
     */
    public function __get(string $name): mixed
    {
        if (method_exists($this, $name) === false) {
            $this->throwBadMethodException($name);
        }

        try {
            return $this->{$name}();
        } catch (ArgumentCountError) {
            throw new LogicException(
                sprintf('Cannot access property "%s". Use the "%s()" method instead.', $name, $name)
            );
        }
    }

    /**
     * Dynamically handle call into builder instance.
     *
     * @param  array<int, callable|string|int>  $arguments
     *
     * @throws \BadMethodCallException
     */
    public function __call(string $name, array $arguments): self
    {
        foreach ($this->patterns as $pattern) {
            if ($pattern->getName() === $name || $pattern->alias() === $name) {
                $this->pushToPattern($pattern->getPattern());

                return $this;
            }
        }

        $this->throwBadMethodException($name);
    }

    /**
     * Throws a logical exception when assigning a property.
     *
     * @throws \LogicException
     */
    public function __set(string $name, mixed $value): void
    {
        throw new LogicException(sprintf('Setter "%s" is not acceptable.', $name));
    }

    /**
     * Sanitize the given expression value.
     */
    public static function sanitize(string|int $value): string
    {
        $value = (string) $value;

        return $value !== '' ? preg_quote($value, '/') : $value;
    }

    /**
     * Adds a new value to the pattern array.
     */
    public function pushToPattern(string|BackedEnum $value): self
    {
        $this->pattern[] = $value instanceof BackedEnum ? (string) $value->value : $value;

        return $this;
    }

    /**
     * Sets the context to the builder instance.
     */
    public function addContext(string $string): self
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
     * Creates negation to next token.
     */
    public function not(): Negate
    {
        return new Negate(
            builder: $this,
        );
    }

    /**
     * Adds a match to what comes before or after.
     */
    public function oneOf(string ...$value): self
    {
        $this->pushToPattern(
            implode('|', array_map([$this, 'sanitize'], $value))
        );

        return $this;
    }

    /**
     * Adds an alternative to the pattern.
     */
    public function or(): self
    {
        $this->pushToPattern('|');

        return $this;
    }

    /**
     * Adds a match of any character to the pattern.
     */
    public function anything(): self
    {
        $this->pushToPattern('.*');

        return $this;
    }

    /**
     * Dynamically call the registered pattern.
     */
    public function pattern(string $string): self
    {
        return $this->__call($string, []);
    }

    /**
     * Throws a bad method call exception for the given method.
     *
     * @throws \BadMethodCallException
     */
    protected function throwBadMethodException(string $method): void
    {
        throw new BadMethodCallException(sprintf('Method "%s" does not exist in %s.', $method, self::class));
    }

    /**
     * Register the given Patterns with the builder.
     *
     * @param  array<int, class-string<\Rudashi\Contracts\PatternContract>>  $patterns
     */
    private function registerPatterns(array $patterns): self
    {
        foreach ($patterns as $pattern) {
            if (! is_subclass_of($pattern, PatternContract::class)) {
                throw new InvalidArgumentException(
                    sprintf('Class "%s" must implement PatternContract.', $pattern)
                );
            }

            $this->patterns[] = new $pattern();
        }

        return $this;
    }
}
