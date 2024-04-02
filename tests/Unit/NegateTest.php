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
    'get',
    ...Negate::$guardedMethods,
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

    it('returns the negation of letters', function () {
        expect(negation()->letters()->get())
            ->toBeString()
            ->toBe('/[^a-zA-Z]+/');
    });

    it('returns the negation of lowerLetter', function () {
        expect(negation()->lowerLetter()->get())
            ->toBeString()
            ->toBe('/[^a-z]/');
    });

    it('returns the negation of lowerLetters', function () {
        expect(negation()->lowerLetters()->get())
            ->toBeString()
            ->toBe('/[^a-z]+/');
    });

    it('returns the negation of any', function () {
        expect(negation()->anyOf('abc')->get())
            ->toBeString()
            ->toBe('/[^abc]/');
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
});

/**
 * Higher-Order methods
 */
describe('Higher-Order methods', function () {
    it('returns the negation of exactly', function () {
        expect(negation()->exactly('foo bar')->get())
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
