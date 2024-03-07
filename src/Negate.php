<?php

declare(strict_types=1);

namespace Rudashi;

/**
 * @mixin \Rudashi\FluentBuilder
 */
class Negate
{
    public function __construct(
        private FluentBuilder $builder,
    ) {
    }
}
