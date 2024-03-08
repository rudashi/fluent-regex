<?php

declare(strict_types=1);

use Rudashi\Negate;

it('can create negation')
    ->expect(negation())
    ->toBeInstanceOf(Negate::class);

it('thrown an exception if the property has no method assigned', function () {
    expect(negation()->get());
})->throws(
    exception: LogicException::class,
    exceptionMessage: 'Method "get" is not extendable by "Negation".'
);

it('can call builder methods')
    ->expect(negation()->letter()->get())
    ->toBeString()
    ->toBe('/[^a-zA-Z]/');

it('returns the negation of whitespaces')
    ->expect(negation()->whitespace()->get())
    ->toBeString()
    ->toBe('/[^\s]/');

it('returns the negation of non whitespaces')
    ->expect(negation()->nonWhitespace()->get())
    ->toBeString()
    ->toBe('/[^\S]/');
