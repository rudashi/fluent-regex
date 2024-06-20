<?php

declare(strict_types=1);

use Rudashi\FluentBuilder;
use Rudashi\Regex;

it('returns messy pattern', function () {
    $regex = Regex::build()
        ->exactly('foo')
        ->whitespace()
        ->anyOf('bar baz')
        ->oneOrMore();

    expect($regex->get())
        ->toBe('/foo\s[bar baz]+/');
});

it('returns pattern for single letter and multiple digits', function () {
    $regex = Regex::build()
        ->letter()
        ->digits();

    expect($regex->get())
        ->toBe('/[a-zA-Z]\d+/');
});

it('returns first README.md example', function () {
    $regex = Regex::build()
        ->startOfLine()
        ->capture(fn (FluentBuilder $fluent) => $fluent->find('http')->or->find('https'))
        ->then('://')
        ->ignoreCase();

    expect($regex->get())
        ->toBe('/^(http|https)\:\/\//i');
});

it('checks the second README.md example', function () {
    $regex = Regex::for('https://100commitow.pl/')->find('100commitow');

    expect($regex->check())
        ->toBeTrue();
});
