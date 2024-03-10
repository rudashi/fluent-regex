<?php

declare(strict_types=1);

namespace Tests;

use Rudashi\Concerns\Dumpable;

arch('globals', function () {
    expect(['dd', 'dump', 'die', 'var_dump', 'sleep'])
        ->not->toBeUsed()
        ->ignoring(Dumpable::class);
});

arch('traits', function () {
    expect('Rudashi\Concerns')
        ->toBeTraits();
});
