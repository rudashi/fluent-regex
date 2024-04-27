<?php

declare(strict_types=1);

use Rudashi\Contracts\PatternContract;
use Rudashi\Patterns\Pattern;

function fakePattern(): PatternContract {
    return new class() extends Pattern implements PatternContract {
        public static string $name = 'fake-pattern';

        public function getName(): string
        {
            return 'diff-name';
        }
    };
}

it('can return static name', function () {
    expect(fakePattern()::$name)
        ->toBe('fake-pattern');
});

it('can return pattern name', function () {
    expect(fakePattern()->getName())
        ->toBe('diff-name')
        ->not->toBe(fakePattern()::$name);
});

it('can use alias', function () {
    $pattern = fakePattern()->alias();

    expect($pattern)
        ->toBe('fakePattern');
});

it('can use complex name as alias', function () {
    fakePattern()::$name = 'Very complex-pattern nAMe';

    expect(fakePattern()->alias())
        ->toBe('veryComplexPatternName');
});
