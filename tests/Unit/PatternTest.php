<?php

declare(strict_types=1);

use Rudashi\Contracts\PatternContract;
use Rudashi\Pattern;

function fakePattern(): Pattern
{
    return new class() extends Pattern implements PatternContract {
        protected static string $name = 'fake-pattern';

        public function getName(): string
        {
            return 'diff-name';
        }
    };
}

it('can return static name', function () {
    $pattern = fakePattern();

    try {
        $reflectProperty = (new ReflectionClass($pattern))->getProperty('name')->getValue($pattern);

        expect($reflectProperty)->toBe('fake-pattern');
    } catch (ReflectionException $e) {
        $this->markTestSkipped($e->getMessage());
    }
});

it('can return pattern name', function () {
    expect(fakePattern()->getName())
        ->not->toBe('fake-pattern')
        ->toBe('diff-name');
});

it('can use alias', function () {
    $pattern = fakePattern()->alias();

    expect($pattern)
        ->toBe('diffName');
});
