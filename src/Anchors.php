<?php

declare(strict_types=1);

namespace Rudashi;

use LogicException;

class Anchors
{
    /**
     * @var array<int, string>
     */
    protected array $prefix = [];

    /**
     * @var array<int, string>
     */
    protected array $suffix = [];

    public function __construct(
        private readonly FluentBuilder $builder,
        private readonly string $delimiter,
    ) {
    }

    public function start(): FluentBuilder
    {
        if ($this->prefix !== []) {
            $this->throwAnchorException(__FUNCTION__);
        }

        $this->prefix[] = '^';

        return $this->builder;
    }

    public function end(): FluentBuilder
    {
        if ($this->suffix !== []) {
            $this->throwAnchorException(__FUNCTION__);
        }

        $this->suffix[] = '$';

        return $this->builder;
    }

    /**
     * @return array<int, string>
     */
    public function getPrefix(): array
    {
        return [$this->delimiter, ...$this->prefix];
    }

    /**
     * @return array<int, string>
     */
    public function getSuffix(): array
    {
        return [...$this->suffix, $this->delimiter];
    }

    protected function throwAnchorException(string $method): never
    {
        throw new LogicException(sprintf('The "%s" anchor has already been called.', $method));
    }
}
