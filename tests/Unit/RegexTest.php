<?php

declare(strict_types=1);

use Rudashi\FluentBuilder;
use Rudashi\Regex;

it('can statically create a Builder', function () {
    $data = Regex::build();

    expect($data)
        ->toBeInstanceOf(FluentBuilder::class);
});

it('can statically add context to the Builder', function () {
    $data = Regex::for('https://rudashi.github.io/');

    expect($data)
        ->toBeInstanceOf(FluentBuilder::class);
});

it('can create Builder', function () {
    $data = (new Regex())->newBuilder();

    expect($data)
        ->toBeInstanceOf(FluentBuilder::class);
});

it('can create a Builder at the start of the string', function () {
    $data = Regex::start();

    expect($data)
        ->toBeInstanceOf(FluentBuilder::class)
        ->get()->toBe('/^/');
});

test('call `startOfLine` - `start()` alias ', function () {
    $data = Regex::startOfLine();

    expect($data)
        ->toBeInstanceOf(FluentBuilder::class)
        ->get()->toBe('/^/');
});