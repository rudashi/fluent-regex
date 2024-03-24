<?php

declare(strict_types=1);

it('can add `zeroOrOne` quantifier', function () {
    $regex = fluentBuilder()->word()->zeroOrOne();

    expect($regex->get())
        ->toBe('/\w?/');
});

it('can add `zeroOrMore` quantifier', function () {
    $regex = fluentBuilder()->word()->zeroOrMore();

    expect($regex->get())
        ->toBe('/\w*/');
});

it('can add `oneOrMore` quantifier', function () {
    $regex = fluentBuilder()->word()->oneOrMore();

    expect($regex->get())
        ->toBe('/\w+/');
});

it('can add `times` quantifier', function () {
    $regex = fluentBuilder()->word()->times(1);

    expect($regex->get())
        ->toBe('/\w{1}/');
});

it('can add `min` quantifier', function () {
    $regex = fluentBuilder()->word()->min(2);

    expect($regex->get())
        ->toBe('/\w{2,}/');
});

it('can add `between` quantifier', function () {
    $regex = fluentBuilder()->word()->between(1, 3);

    expect($regex->get())
        ->toBe('/\w{1,3}/');
});

it('can add the quantifier `between` to act like `min`', function () {
    $regex = fluentBuilder()->word()->between(1);

    expect($regex->get())
        ->toBe('/\w{1,}/');
});

it('thrown an exception when trying to negate the quantifier', function (string $method) {
    expect(fn () => fluentBuilder()->not->{$method}())
        ->toThrow(
            exception: LogicException::class,
            exceptionMessage: 'Method "'.$method.'" is not extendable by "Negation".'
        );
})->with([
    'zeroOrOne',
    'zeroOrMore',
    'oneOrMore',
    'times',
    'min',
    'between',
]);
