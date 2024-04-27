<?php

declare(strict_types=1);

namespace Rudashi\Contracts;

interface PatternContract
{
    public function alias(): string;

    public function getName(): string;

    public function getPattern(): string;
}
