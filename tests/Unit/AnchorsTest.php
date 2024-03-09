<?php

declare(strict_types=1);

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
