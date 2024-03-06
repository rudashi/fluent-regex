<?php

declare(strict_types=1);

it('can add a `exactly` token', function () {
    $regex = fluentBuilder()->exactly('foo bar');

    expect($regex->get())
        ->toBe('/foo bar/');
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
