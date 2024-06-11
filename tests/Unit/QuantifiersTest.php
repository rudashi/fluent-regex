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

it('threw an exception when the parameter is a negative number for the `times` quantifier', function () {
    expect(fn () => fluentBuilder()->word()->times(-1))
        ->toThrow(
            exception: LogicException::class,
            exceptionMessage: 'The "number" parameter must be a positive integer.'
        );
});

it('threw an exception when the parameter is a negative number for the `min` quantifier', function () {
    expect(fn () => fluentBuilder()->word()->min(-1))
        ->toThrow(
            exception: LogicException::class,
            exceptionMessage: 'The "min" parameter must be a positive integer.'
        );
});

it('threw an exception when the parameters are a negative number for the `between` quantifier', function () {
    expect(fn () => fluentBuilder()->word()->between(-1, -3))
        ->toThrow(
            exception: LogicException::class,
            exceptionMessage: 'The "min" parameter must be a positive integer.'
        );
});

it('threw an exception when the first parameter is a negative number for the `between` quantifier', function () {
    expect(fn () => fluentBuilder()->word()->between(-1))
        ->toThrow(
            exception: LogicException::class,
            exceptionMessage: 'The "min" parameter must be a positive integer.'
        );
});

it('threw an exception when the second parameter is a negative number for the `between` quantifier', function () {
    expect(fn () => fluentBuilder()->word()->between(1, -2))
        ->toThrow(
            exception: LogicException::class,
            exceptionMessage: 'The "max" parameter must be a positive integer.'
        );
});

it('thrown an exception when trying to negate the quantifier', function (string $method) {
    expect(fn () => fluentBuilder()->not->{$method}())
        ->toThrow(
            exception: LogicException::class,
            exceptionMessage: 'Method "' . $method . '" is not extendable by "Negation".'
        );
})->with([
    'zeroOrOne',
    'zeroOrMore',
    'oneOrMore',
    'times',
    'min',
    'between',
]);

describe('Properties', function () {
    it('allows property `zeroOrOne` to be accessed', function () {
        $regex = fluentBuilder()->word->zeroOrOne;

        expect($regex->get())
            ->toBe('/\w?/');
    });

    it('allows property `zeroOrMore` to be accessed', function () {
        $regex = fluentBuilder()->word->zeroOrMore;

        expect($regex->get())
            ->toBe('/\w*/');
    });

    it('allows property `oneOrMore` to be accessed', function () {
        $regex = fluentBuilder()->word->oneOrMore;

        expect($regex->get())
            ->toBe('/\w+/');
    });

    it('throw an exception when trying to access a quantifier property', function (string $method) {
        expect(fn () => fluentBuilder()->$method)
            ->toThrow(
                exception: LogicException::class,
                exceptionMessage: 'Cannot access property "' . $method . '". Use the "' . $method . '()" method instead'
            );
    })->with([
        'times',
        'min',
        'between',
    ]);
});
