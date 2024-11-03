<?php

declare(strict_types=1);

use Rudashi\Anchors;

mutates(Anchors::class);

it('can add `start of a string` anchor', function () {
    $regex = fluentBuilder()->start();

    expect($regex->get())
        ->toBe('/^/');
});

it('can add alias of `start` anchor', function () {
    $regex = fluentBuilder()->startOfLine();

    expect($regex->get())
        ->toBe('/^/');
});

it('can add `end of a string` anchor', function () {
    $regex = fluentBuilder()->end();

    expect($regex->get())
        ->toBe('/$/');
});

it('can add alias of `end` anchor', function () {
    $regex = fluentBuilder()->endOfLine();

    expect($regex->get())
        ->toBe('/$/');
});

it('can add `start` and `end` anchor', function () {
    $regex = fluentBuilder()->start()->end();

    expect($regex->get())
        ->toBe('/^$/');
});

it('thrown an exception when trying to negate the anchor', function (string $method) {
    expect(fn () => fluentBuilder()->not->{$method}())
        ->toThrow(
            exception: LogicException::class,
            exceptionMessage: 'Method "' . $method . '" is not extendable by "Negation".'
        );
})->with([
    'start',
    'startOfLine',
    'end',
    'endOfLine',
]);

it('thrown an exception when trying to invoke anchor twice', function (string $method, string $called) {
    expect(fn () => fluentBuilder()->{$method}()->{$method}())
        ->toThrow(
            exception: LogicException::class,
            exceptionMessage: 'The "' . $called . '" anchor has already been called.'
        );
})->with([
    ['start', 'start'],
    ['startOfLine', 'start'],
    ['end', 'end'],
    ['endOfLine', 'end'],
]);

describe('Properties', function () {
    it('allows property `start` to be accessed', function () {
        $regex = fluentBuilder()->start;

        expect($regex->get())
            ->toBe('/^/');
    });

    it('allows property `startOfLine` to be accessed', function () {
        $regex = fluentBuilder()->startOfLine;

        expect($regex->get())
            ->toBe('/^/');
    });

    it('allows property `end` to be accessed', function () {
        $regex = fluentBuilder()->end;

        expect($regex->get())
            ->toBe('/$/');
    });

    it('allows property `endOfLine` to be accessed', function () {
        $regex = fluentBuilder()->endOfLine;

        expect($regex->get())
            ->toBe('/$/');
    });
});
