<?php

declare(strict_types=1);

namespace Rudashi;

use LogicException;

final class Anchors
{
    /**
     * List of assigned starting anchors.
     *
     * @var array<int, string>
     */
    private array $prefix = [];

    /**
     * List of assigned ending anchors.
     *
     * @var array<int, string>
     */
    private array $suffix = [];

    /**
     * Create an instance of Anchors.
     */
    public function __construct(
        private readonly FluentBuilder $builder,
        private readonly string $delimiter,
    ) {
    }

    /**
     * Adds a starting anchor.
     */
    public function start(): FluentBuilder
    {
        if ($this->prefix !== []) {
            $this->throwAnchorException(__FUNCTION__);
        }

        $this->prefix[] = '^';

        return $this->builder;
    }

    /**
     * Adds an end anchor.
     */
    public function end(): FluentBuilder
    {
        if ($this->suffix !== []) {
            $this->throwAnchorException(__FUNCTION__);
        }

        $this->suffix[] = '$';

        return $this->builder;
    }

    /**
     * Returns a list of starting anchors.
     *
     * @return array<int, string>
     */
    public function getPrefix(): array
    {
        return [
            $this->delimiter,
            ...$this->prefix,
        ];
    }

    /**
     * Returns a list of ending anchors.
     *
     * @return array<int, string>
     */
    public function getSuffix(): array
    {
        return [
            ...$this->suffix,
            $this->delimiter,
        ];
    }

    /**
     * Throws a logical exception when the same flag is reused.
     *
     * @throws \LogicException
     */
    private function throwAnchorException(string $method): never
    {
        throw new LogicException(sprintf('The "%s" anchor has already been called.', $method));
    }
}
