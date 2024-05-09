<?php

declare(strict_types=1);

namespace Rudashi;

use LogicException;

class Anchors
{
    /**
     * List of assigned starting anchors.
     *
     * @var array<int, string>
     */
    protected array $prefix = [];

    /**
     * List of assigned ending anchors.
     *
     * @var array<int, string>
     */
    protected array $suffix = [];

    /**
     * Create an instance of Anchors.
     *
     * @param  \Rudashi\FluentBuilder  $builder
     * @param  string  $delimiter
     */
    public function __construct(
        private readonly FluentBuilder $builder,
        private readonly string $delimiter,
    ) {
    }

    /**
     * Adds a starting anchor.
     *
     * @return \Rudashi\FluentBuilder
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
     *
     * @return \Rudashi\FluentBuilder
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
        return [$this->delimiter, ...$this->prefix];
    }

    /**
     * Returns a list of ending anchors.
     *
     * @return array<int, string>
     */
    public function getSuffix(): array
    {
        return [...$this->suffix, $this->delimiter];
    }

    /**
     * Throws a logical exception when the same flag is reused.
     *
     * @param  string  $method
     * @return never
     *
     * @throws \LogicException
     */
    protected function throwAnchorException(string $method): never
    {
        throw new LogicException(sprintf('The "%s" anchor has already been called.', $method));
    }
}
