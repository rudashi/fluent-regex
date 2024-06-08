<?php

declare(strict_types=1);

use Rudashi\FluentBuilder;
use Rudashi\Negate;

it('can create negation', function () {
    expect(negation())
        ->toBeInstanceOf(Negate::class);
});

it('can call builder methods', function () {
    expect(negation()->letter())
        ->toBeInstanceOf(FluentBuilder::class);
});

it('thrown an exception if the property has no method assigned', function (string $method) {
    expect(fn () => negation()->{$method}())
        ->toThrow(
            exception: LogicException::class,
            exceptionMessage: 'Method "' . $method . '" is not extendable by "Negation".'
        );
})->with([
    // FluentBuilder
    'get',
    'check',
    'match',
    'addContext',
    'oneOf',
    'or',
    'anything',

    // Anchors
    'start',
    'startOfLine',
    'end',
    'endOfLine',

    // Flags
    'ignoreCase',
    'multiline',
    'matchNewLine',
    'ignoreWhitespace',
    'utf8',

    // Quantifiers
    'zeroOrOne',
    'zeroOrMore',
    'oneOrMore',
    'times',
    'min',
    'between',
]);

/**
 * Built-in methods
 */
describe('Built-in methods', function () {
    it('returns the negation of letter', function () {
        expect(negation()->letter()->get())
            ->toBeString()
            ->toBe('/[^a-zA-Z]/');
    });

    it('returns the negation of lowerLetter', function () {
        expect(negation()->lowerLetter()->get())
            ->toBeString()
            ->toBe('/[^a-z]/');
    });

    it('returns the negation of any', function () {
        expect(negation()->anyOf('abc')->get())
            ->toBeString()
            ->toBe('/[^abc]/');
    });

    it('return the negation of chained `anyOf method', function () {
        $regex = negation()->anyOf(
            fn (FluentBuilder $builder) => $builder->letter()->number()->character('._%+-')
        );

        expect($regex->get())
            ->toBe('/[^a-zA-Z0-9._%+-]/');
    });

    it('returns the negation of number', function () {
        expect(negation()->number()->get())
            ->toBeString()
            ->toBe('/[^0-9]/');
    });

    it('returns the negation of numbers', function () {
        expect(negation()->numbers()->get())
            ->toBeString()
            ->toBe('/[^0-9]+/');
    });

    it('returns the negation of capture', function () {
        $regex = fluentBuilder()
            ->exactly('-')
            ->not->capture(fn (FluentBuilder $fluent) => $fluent->exactly('.')->letter())
            ->end();

        expect($regex->get())
            ->toBe('/\-(?:\.[a-zA-Z])$/');
    });

    it('returns the negation of capture alias - `group', function () {
        $regex = fluentBuilder()
            ->exactly('-')
            ->not->group(fn (FluentBuilder $fluent) => $fluent->exactly('.')->letter())
            ->end();

        expect($regex->get())
            ->toBe('/\-(?:\.[a-zA-Z])$/');
    });

    it('can use the lookbehind parameter in the `capture` method', function () {
        $regex = negation()->capture(fn (FluentBuilder $fluent) => $fluent->exactly('.')->letter(), true);

        expect($regex->get())
            ->toBe('/(?<!\.[a-zA-Z])/');
    });

    it('can use the lookahead parameter in the `capture` method', function () {
        $regex = negation()->capture(fn (FluentBuilder $fluent) => $fluent->exactly('.')->letter(), lookahead: true);

        expect($regex->get())
            ->toBe('/(?!\.[a-zA-Z])/');
    });

    it('threw an exception when use lookahead and lookbehind at the same time', function () {
        expect(fn () => negation()->capture(fn (FluentBuilder $fluent) => $fluent->letter(), true, true))
            ->toThrow(
                exception: LogicException::class,
                exceptionMessage: 'Unable to look behind and ahead at the same time.',
            );
    });
});

/**
 * Higher-Order methods
 */
describe('Higher-Order methods', function () {
    it('returns the negation of character', function () {
        expect(negation()->character('._%+-')->get())
            ->toBeString()
            ->toBe('/[^._%+-]/');
    });

    it('returns the negation of and', function () {
        expect(negation()->and('._%+-')->get())
            ->toBeString()
            ->toBe('/[^._%+-]/');
    });

    it('returns the negation of exactly', function () {
        expect(negation()->exactly('foo bar')->get())
            ->toBeString()
            ->toBe('/[^foo bar]/');
    });

    it('returns the negation of find', function () {
        expect(negation()->find('foo bar')->get())
            ->toBeString()
            ->toBe('/[^foo bar]/');
    });

    it('returns the negation of then', function () {
        expect(negation()->then('foo bar')->get())
            ->toBeString()
            ->toBe('/[^foo bar]/');
    });

    it('returns the negation of whitespaces', function () {
        expect(negation()->whitespace()->get())
            ->toBeString()
            ->toBe('/[^\s]/');
    });

    it('returns the negation of non whitespaces', function () {
        expect(negation()->nonWhitespace()->get())
            ->toBeString()
            ->toBe('/[^\S]/');
    });

    it('returns the negation of digit', function () {
        expect(negation()->digit()->get())
            ->toBeString()
            ->toBe('/[^\d]/');
    });

    it('returns the negation of digits', function () {
        expect(negation()->digits()->get())
            ->toBeString()
            ->toBe('/[^\d+]/');
    });

    it('returns the negation of non digit', function () {
        expect(negation()->nonDigit()->get())
            ->toBeString()
            ->toBe('/[^\D]/');
    });

    it('returns the negation of non digits', function () {
        expect(negation()->nonDigits()->get())
            ->toBeString()
            ->toBe('/[^\D+]/');
    });

    it('returns the negation of word', function () {
        expect(negation()->word()->get())
            ->toBeString()
            ->toBe('/[^\w]/');
    });

    it('returns the negation of words', function () {
        expect(negation()->words()->get())
            ->toBeString()
            ->toBe('/[^\w+]/');
    });

    it('returns the negation of tab', function () {
        expect(negation()->tab()->get())
            ->toBeString()
            ->toBe('/[^\t]/');
    });

    it('returns the negation of carriageReturn', function () {
        expect(negation()->carriageReturn()->get())
            ->toBeString()
            ->toBe('/[^\r]/');
    });

    it('returns the negation of newline', function () {
        expect(negation()->newline()->get())
            ->toBeString()
            ->toBe('/[^\n]/');
    });

    it('returns the negation of linebreak', function () {
        expect(negation()->linebreak()->get())
            ->toBeString()
            ->toBe('/[^\r|\n]/');
    });
});
