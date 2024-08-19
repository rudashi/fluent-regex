<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

use Rudashi\Contracts\PatternContract;

trait HasPatterns
{
    /**
     * Dynamically handle call into builder instance.
     *
     * @param  array<int, \Closure|string|int>  $arguments
     *
     * @throws \BadMethodCallException
     */
    public function __call(string $name, array $arguments): self
    {
        foreach ($this->patterns as $pattern) {
            if ($pattern->getName() === $name || $pattern->alias() === $name) {
                return $this->pushToPattern($pattern->getPattern());
            }
        }

        $this->throwBadMethodException($name);
    }

    /**
     * Dynamically call the registered pattern.
     */
    public function pattern(string $string): self
    {
        return $this->__call($string, []);
    }

    /**
     * Register the given Patterns with the builder.
     *
     * @param  array<int, class-string<\Rudashi\Contracts\PatternContract>>  $patterns
     */
    private function registerPatterns(array $patterns): void
    {
        array_map(function (string $pattern): void {
            if (! is_subclass_of($pattern, PatternContract::class)) {
                $this->throwArgumentException(sprintf('Class "%s" must implement PatternContract.', $pattern));
            }

            $this->patterns[] = new $pattern();
        }, $patterns);
    }
}
