<?php

declare(strict_types=1);

use Rudashi\Negate;

it('can create negation', function () {
    expect(negation())
        ->toBeInstanceOf(Negate::class);
});

it('can call builder methods')
    ->expect(negation()->letter()->get())
    ->toBeString()
    ->toBe('/[^a-zA-Z]/');

it('thrown an exception if the property has no method assigned', function () {
    expect(negation()->get());
})->throws(
    exception: LogicException::class,
    exceptionMessage: 'Method "get" is not extendable by "Negation".'
);