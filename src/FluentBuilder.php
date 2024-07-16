<?php

declare(strict_types=1);

namespace Rudashi;

use ArgumentCountError;
use BackedEnum;
use Rudashi\Concerns\Dumpable;
use Rudashi\Concerns\Flags;
use Rudashi\Concerns\Group;
use Rudashi\Concerns\HasAnchors;
use Rudashi\Concerns\HasPatterns;
use Rudashi\Concerns\HasTokens;
use Rudashi\Concerns\Quantifiers;
use Rudashi\Concerns\Returnable;
use Rudashi\Concerns\Sanitizer;
use Rudashi\Concerns\ThrowExceptions;
use Rudashi\Contracts\PatternContract;

/**
 * @property Negate $not Creates the negative pattern
 * @property static $or Adds alternative
 */
final class FluentBuilder
{
    use HasAnchors;
    use HasTokens;
    use HasPatterns;
    use Flags;
    use Dumpable;
    use ThrowExceptions;
    use Quantifiers;
    use Group;
    use Returnable;
    use Sanitizer;

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
            $this->throwLogicException(
                sprintf('Cannot access property "%s". Use the "%s()" method instead.', $name, $name)
            );
        }
    }

    /**
     * Throws a logical exception when assigning a property.
     *
     * @throws \LogicException
     */
    public function __set(string $name, mixed $value): never
    {
        $this->throwLogicException(sprintf('Setter "%s" is not acceptable.', $name));
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
            $this->throwLogicException(
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
        return $this->pushToPattern(
            implode('|', array_map([$this, 'sanitize'], $value))
        );
    }

    /**
     * Adds an alternative to the pattern.
     */
    public function or(): self
    {
        return $this->pushToPattern('|');
    }

    /**
     * Adds a match of any character to the pattern.
     */
    public function anything(): self
    {
        return $this->pushToPattern('.*');
    }
}
