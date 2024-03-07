<?php

declare(strict_types=1);

use Rudashi\Negate;

it('can add context to the builder', function () {
    $regex = fluentBuilder()->setContext('test');

    try {
        $reflectProperty = (new ReflectionClass($regex))->getProperty('context')->getValue($regex);

        expect($reflectProperty)->toBe('test');
    } catch (ReflectionException $e) {
        $this->markTestSkipped($e->getMessage());
    }
});

it('allows properties to be accessed', function () {
    expect(fluentBuilder()->not)
        ->toBeInstanceOf(Negate::class);
});

it('thrown an exception if the property has no method assigned', function () {
    // @phpstan-ignore-next-line
    expect(fluentBuilder()->fooBar);
})->throws(
    exception: BadMethodCallException::class,
    exceptionMessage: 'Method "fooBar" does not exist in Rudashi\FluentBuilder.'
);

it('thrown an exception if you assign a value to the property', function () {
    // @phpstan-ignore-next-line
    expect(fluentBuilder()->foo = 'bar');
})->throws(
    exception: LogicException::class,
    exceptionMessage: 'Setter "foo" is not acceptable.'
);

/**
 * Returning results
 */
it('can return a string pattern', function () {
    expect(fluentBuilder()->get())
        ->toBe('//');
});
