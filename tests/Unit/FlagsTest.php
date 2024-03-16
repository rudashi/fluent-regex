<?php

declare(strict_types=1);

it('can add `insensitive` flag', function () {
    $regex = fluentBuilder()->ignoreCase();

    expect($regex->get())
        ->toBe('//i');
});

it('can add `multiline` flag', function () {
    $regex = fluentBuilder()->multiline();

    expect($regex->get())
        ->toBe('//m');
});

it('can add `dot all` flag', function () {
    $regex = fluentBuilder()->matchNewLine();

    expect($regex->get())
        ->toBe('//s');
});

it('can add `extended` flag', function () {
    $regex = fluentBuilder()->ignoreWhitespace();

    expect($regex->get())
        ->toBe('//x');
});

it('can add `unicode` flag', function () {
    $regex = fluentBuilder()->utf8();

    expect($regex->get())
        ->toBe('//u');
});

it('thrown an exception when trying to negate the flag', function () {
    expect(fn () => fluentBuilder()->not->ignoreCase())
        ->toThrow(
            exception: LogicException::class,
            exceptionMessage: 'Method "ignoreCase" is not extendable by "Negation".'
        );
});
