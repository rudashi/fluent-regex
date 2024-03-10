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

it('thrown an exception if the property has no method assigned', function () {
    expect(negation()->get());
})->throws(
    exception: LogicException::class,
    exceptionMessage: 'Method "get" is not extendable by "Negation".'
);

/**
 * Higher-Order methods
 */
it('returns the negation of exactly', function () {
    expect(negation()->exactly('foo bar')->get())
        ->toBeString()
        ->toBe('/[^foo bar]/');
});

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

it('returns the negation of non digits', function () {
    expect(negation()->digits()->get())
        ->toBeString()
        ->toBe('/[^\d+]/');
});
