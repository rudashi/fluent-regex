<?php

declare(strict_types=1);

use Rudashi\FluentBuilder;
use Rudashi\Negate;
use Rudashi\Patterns\EmailPattern;

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
describe('negation', function () {
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
});

/**
 * Exceptions
 */
describe('exceptions', function () {
    it('thrown an exception if the property is not callable', function (string $property) {
        expect(fn () => fluentBuilder()->$property)
            ->toThrow(
                exception: BadMethodCallException::class,
                exceptionMessage: 'Cannot access property "' . $property . '". Use the "' . $property . '()" method instead.'
            );
    })->with(['capture', 'maybe']);

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
});

/**
 * Capture
 */
describe('capture', function () {
    it('can use the `capture` method to group tokens', function () {
        $regex = fluentBuilder()
            ->exactly('-')
            ->capture(fn (FluentBuilder $fluent) => $fluent->exactly('.')->letter())
            ->end();

        expect($regex->get())
            ->toBe('/\-(\.[a-zA-Z])$/');
    });

    it('can use `capture` alias method - `group`', function () {
        $regex = fluentBuilder()
            ->exactly('-')
            ->group(fn (FluentBuilder $fluent) => $fluent->exactly('.')->letter())
            ->end();

        expect($regex->get())
            ->toBe('/\-(\.[a-zA-Z])$/');
    });

    it('can use the `maybe` method to group tokens', function () {
        $regex = fluentBuilder()
            ->exactly('-')
            ->maybe(fn (FluentBuilder $fluent) => $fluent->exactly('.')->letter())
            ->end();

        expect($regex->get())
            ->toBe('/\-(\.[a-zA-Z])?$/');
    });
});

/**
 * Or
 */
describe('or', function () {
    it('can add an `oneOf`', function () {
        $regex = fluentBuilder()->oneOf('a', 'b', '.');

        expect($regex->get())
            ->toBe('/a|b|\./');
    });

    it('can add empty values to `oneOf`', function () {
        $regex = fluentBuilder()->oneOf();

        expect($regex->get())
            ->toBe('//');
    });

    it('can add an `or`', function () {
        $regex = fluentBuilder()->exactly('a')->or()->exactly('b');

        expect($regex->get())
            ->toBe('/a|b/');
    });

    it('allows property `or` to be accessed', function () {
        $regex = fluentBuilder()->exactly('a')->or->exactly('b');

        expect($regex->get())
            ->toBe('/a|b/');
    });
});

/**
 * Anything token
 */
it('can add an `anything` token', function () {
    $regex = fluentBuilder()->anything();

    expect($regex->get())
        ->toBe('/.*/');
});

describe('patterns call', function () {
    it('can use `pattern`', function () {
        $regex = fluentPattern(EmailPattern::class);

        // @phpstan-ignore-next-line
        expect($regex->email())
            ->toBeInstanceOf(FluentBuilder::class)
            ->get()->toBe('/\w+(?:\.\w+)*@(?:[\w-]+\.)+[\w-]{2,}/');
    });

    it('can call `pattern`', function () {
        $regex = fluentPattern(EmailPattern::class);

        expect($regex->pattern(EmailPattern::$name))
            ->toBeInstanceOf(FluentBuilder::class)
            ->get()->toBe('/\w+(?:\.\w+)*@(?:[\w-]+\.)+[\w-]{2,}/');
    });

    it('threw an exception when a non-existent `pattern` call is used', function () {
        // @phpstan-ignore-next-line
        expect(fn () => fluentBuilder()->email())
            ->toThrow(
                exception: BadMethodCallException::class,
                exceptionMessage: 'Method "email" does not exist in Rudashi\FluentBuilder.'
            );
    });

    it('threw an exception when use incorrect pattern', function () {
        // @phpstan-ignore-next-line
        expect(fn () => fluentPattern('className'))
            ->toThrow(
                exception: InvalidArgumentException::class,
                exceptionMessage: 'Class "className" must implement PatternContract.',
            );
    });
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
describe('returning results', function () {
    it('can return a string pattern', function () {
        expect(fluentBuilder()->get())
            ->toBe('//');
    });

    it('can validate context against pattern', function (string $value, bool $expectation) {
        $regex = fluentBuilder()->setContext('abc')->exactly($value);

        expect($regex->check())
            ->toBe($expectation);
    })->with([
        ['a', true],
        ['y', false],
        ['ab', true],
        ['', false],
    ]);

    it('returns a string matching from the context', function () {
        $regex = fluentBuilder()->setContext('abca')->exactly('a');

        expect($regex->match())
            ->toHaveCount(2)
            ->toMatchArray(['a', 'a']);
    });
});
