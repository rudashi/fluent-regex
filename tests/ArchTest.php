<?php

declare(strict_types=1);

namespace Tests;

use Rudashi\Concerns\Dumpable;

arch('globals')
    ->expect(['dd', 'dump', 'die', 'var_dump', 'sleep'])
    ->not->toBeUsed()
    ->ignoring(Dumpable::class);

arch('traits')
    ->expect('Rudashi\Concerns')
    ->toBeTraits();
