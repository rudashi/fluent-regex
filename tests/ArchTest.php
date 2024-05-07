<?php

declare(strict_types=1);

namespace Tests;

use Rudashi\Concerns\Dumpable;
use Rudashi\Contracts\PatternContract;
use Rudashi\Flag;

arch('strict types are everywhere', function () {
    expect('Rudashi')
        ->toUseStrictTypes();
});

arch('globals', function () {
    expect(['dd', 'dump', 'die', 'var_dump', 'sleep'])
        ->not->toBeUsed()
        ->ignoring(Dumpable::class);
});

arch('traits', function () {
    expect('Rudashi\Concerns')
        ->toBeTraits();
});

arch('interfaces', function () {
    expect('Rudashi\Contracts')
        ->toBeInterfaces();
});

arch('enums', function () {
    expect(Flag::class)
        ->toBeStringBackedEnum();
});

arch('patterns', function () {
    expect('Rudashi\Patterns')
        ->toHaveSuffix('Pattern')
        ->toOnlyImplement(PatternContract::class);
});
