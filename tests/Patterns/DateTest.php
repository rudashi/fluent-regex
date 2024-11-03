<?php

declare(strict_types=1);

use Rudashi\FluentBuilder;
use Rudashi\Patterns\DatePattern;
use Rudashi\Regex;

dataset('dates', [
    ['12/31/2023', true],
    ['12-31-2023', true],
    ['12.31.2023', true],
    ['30/01/2024', true],
    ['30-01-2024', true],
    ['05.12.2023', true],
    ['2024/01/30', true],
    ['2023-05-12', true],
    ['2024.01.30', true],
    ['2024-5-1', true],
    ['2024/5/1', true],
    ['2024.5.1', true],
    ['2024-5-30', true],
    ['2024/5/30', true],
    ['2024.5.30', true],

    ['', false],
    ['05-2024-20', false],
    ['05/2024/20', false],
    ['05.2024.20', false],
    ['2024-32-5', false],
    ['2024-32-5', false],
    ['2024/32/5', false],
    ['2024/30/32', false],
    ['2024-30-32', false],
    ['2024.30.32', false],
    ['2024/30/05', false],
    ['2024-30-05', false],
    ['2024.30.05', false],
]);

it('validate dates', function (string $context, bool $expectation) {
    $year = fn (FluentBuilder $fluent) => $fluent->digit->times(4);
    $month = fn (FluentBuilder $fluent) => $fluent->maybe(0)->number(min: 1)->or->find(1)->number(max: 2);
    $day = fn (FluentBuilder $fluent) => $fluent->maybe(0)->number(min: 1)->or->anyOf(12)->number()->or->find(3)->anyOf('01');

    $regex = Regex::for($context)
        ->boundary()
        ->not->group(fn (FluentBuilder $fluent) => $fluent
            ->not->group($year)->anyOf('-/.')->not->group($month)->anyOf('-/.')->not->group($day)
            ->or
            ->not->group($day)->anyOf('-/.')->not->group($month)->anyOf('-/.')->not->group($year)
            ->or
            ->not->group($month)->anyOf('-/.')->not->group($day)->anyOf('-/.')->not->group($year)
        )
        ->boundary();

    expect($regex)
        ->toBeInstanceOf(FluentBuilder::class)
        ->get()->toBe('/\b(?:(?:\d{4})[-\/.](?:0?[1-9]|1[0-2])[-\/.](?:0?[1-9]|[12][0-9]|3[01])|(?:0?[1-9]|[12][0-9]|3[01])[-\/.](?:0?[1-9]|1[0-2])[-\/.](?:\d{4})|(?:0?[1-9]|1[0-2])[-\/.](?:0?[1-9]|[12][0-9]|3[01])[-\/.](?:\d{4}))\b/')
        ->check()->toBe($expectation);
})->with('dates');

describe('predefined DATE pattern', function () {
    beforeEach(function () {
        $this->builder = new FluentBuilder(patterns: [DatePattern::class]);
    });

    it('validates', function (string $context, bool $expectation) {
        $regex = $this->builder->addContext($context)->start()->date()->end();

        expect($regex->check())
            ->toBe($expectation);
    })->with('dates');

    it('finds a date in text', function () {
        $context = "I was born on 1990-05-23. My sister's birthday is 12-08-1995. We moved to our new house on \n
        07/14/2005. My parents got married on 1985/03/29. Our vacation starts on 6-15-2023. The project deadline \n
        is 03:10:2024.";

        $regex = $this->builder->addContext($context)->date();

        expect($regex->match())
            ->toHaveCount(5)
            ->toMatchArray([
                '1990-05-23',
                '12-08-1995',
                '07/14/2005',
                '1985/03/29',
                '6-15-2023',
            ]);
    });
});

it('check DatePattern', function () {
    $pattern = new DatePattern();

    expect($pattern)
        ->toBeInstanceOf(DatePattern::class)
        ->getName()->toBe('date')
        ->getPattern()->toBe('\b(?:(?:\d{4})[-\/.](?:0?[1-9]|1[0-2])[-\/.](?:0?[1-9]|[12][0-9]|3[01])|(?:0?[1-9]|[12][0-9]|3[01])[-\/.](?:0?[1-9]|1[0-2])[-\/.](?:\d{4})|(?:0?[1-9]|1[0-2])[-\/.](?:0?[1-9]|[12][0-9]|3[01])[-\/.](?:\d{4}))\b');
});
