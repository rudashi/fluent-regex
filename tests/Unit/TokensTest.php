<?php

declare(strict_types=1);

it('can add to `pattern` value', function () {
    $regex = fluentBuilder()->pushToPattern('test');

    expect($regex->get())
        ->toBe('/test/');
});

it('can add a `exactly` token', function () {
    $regex = fluentBuilder()->exactly('foo bar');

    expect($regex->get())
        ->toBe('/foo bar/');
});

it('can add a numeric `exactly` token', function () {
    $regex = fluentBuilder()->exactly(41);

    expect($regex->get())
        ->toBe('/41/');
});

it('can add a `letter` token', function () {
    $regex = fluentBuilder()->letter();

    expect($regex->get())
        ->toBe('/[a-zA-Z]/');
});

it('can add a `letters` token', function () {
    $regex = fluentBuilder()->letters();

    expect($regex->get())
        ->toBe('/[a-zA-Z]+/');
});

it('can add a `lowerLetter` token', function () {
    $regex = fluentBuilder()->lowerLetter();

    expect($regex->get())
        ->toBe('/[a-z]/');
});

it('can add a `lowerLetters` token', function () {
    $regex = fluentBuilder()->lowerLetters();

    expect($regex->get())
        ->toBe('/[a-z]+/');
});

it('can add a `whitespaces`', function () {
    $regex = fluentBuilder()->whitespace();

    expect($regex->get())
        ->toBe('/\s/');
});

it('can add a `non whitespaces`', function () {
    $regex = fluentBuilder()->nonWhitespace();

    expect($regex->get())
        ->toBe('/\S/');
});

it('can add a `digit`', function () {
    $regex = fluentBuilder()->digit();

    expect($regex->get())
        ->toBe('/\d/');
});

it('can add a `digits`', function () {
    $regex = fluentBuilder()->digits();

    expect($regex->get())
        ->toBe('/\d+/');
});
