<?php

declare(strict_types=1);

use Rudashi\FluentBuilder;
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

/**
 * Negation
 */
it('can use the `not` method as the negation of the next token', function () {
    expect(fluentBuilder()->not())
        ->toBeInstanceOf(Negate::class);
});

it('allows property `not` to be accessed', function () {
    expect(fluentBuilder()->not)
        ->toBeInstanceOf(Negate::class);
});

it('negates the next token using the `not` property', function () {
    expect(fluentBuilder()->not->word())
        ->toBeInstanceOf(FluentBuilder::class)
        ->get()->toBe('/[^\w]/');
});

/**
 * Exceptions
 */
it('thrown an exception if the property has no method assigned', function () {
    // @phpstan-ignore-next-line
    expect(fn () => fluentBuilder()->fooBar)
        ->toThrow(
            exception: BadMethodCallException::class,
            exceptionMessage: 'Method "fooBar" does not exist in Rudashi\FluentBuilder.'
        );
});

it('thrown an exception if you assign a value to the property', function () {
    // @phpstan-ignore-next-line
    expect(fn () => fluentBuilder()->foo = 'bar')
        ->toThrow(
            exception: LogicException::class,
            exceptionMessage: 'Setter "foo" is not acceptable.'
        );
});

/**
 * Or
 */
it('can add a `oneOf`', function () {
    $regex = fluentBuilder()->oneOf('a', 'b', '.');

    expect($regex->get())
        ->toBe('/a|b|\./');
});

it('can add a `or`', function () {
    $regex = fluentBuilder()->exactly('a')->or()->exactly('b');

    expect($regex->get())
        ->toBe('/a|b/');
});

it('allows property `or` to be accessed', function () {
    $regex = fluentBuilder()->exactly('a')->or->exactly('b');

    expect($regex->get())
        ->toBe('/a|b/');
});

/**
 * Helpers
 */
it('can sanitize provided string', function (string $value, string $expectation) {
    expect(FluentBuilder::sanitize($value))
        ->toBeString()
        ->toBe($expectation);
})->with([
    ['$40', '\\$40'],
    ['*RRRING* Hello?', '\\*RRRING\\* Hello\\?'],
    ['\\.+*?[^]$(){}=!<>|:', '\\\\\\.\\+\\*\\?\\[\\^\\]\\$\\(\\)\\{\\}\\=\\!\\<\\>\\|\\:'],
    ['$40 for a g3/400', '\\$40 for a g3\\/400'],
]);

/**
 * Returning results
 */
it('can return a string pattern', function () {
    expect(fluentBuilder()->get())
        ->toBe('//');
});
