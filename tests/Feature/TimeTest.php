<?php

declare(strict_types=1);

use Rudashi\FluentBuilder;
use Rudashi\Patterns\TimePattern;
use Rudashi\Regex;

dataset('times', [
    ['06:30', true],
    ['06:33', true],
    ['6:30', true],
    ['16:30', true],
    ['16:33', true],
    ['00:00', true],
    ['23:59', true],
    ['06:30:10', true],
    ['06:30:15', true],
    ['06:33:10', true],
    ['06:33:15', true],
    ['16:30:10', true],
    ['16:30:15', true],
    ['16:33:10', true],
    ['16:33:15', true],
    ['12:00 PM', true],
    ['12:00 AM', true],
    ['12:00 pm', true],
    ['12:00 am', true],
    ['12:59 PM', true],
    ['12:59 AM', true],
    ['12:00PM', true],
    ['12:00AM', true],

    ['', false],
    ['6:3', false],
    ['24:00', false],
    ['13:00 PM', false],
    ['13:00 AM', false],
    ['0:21 AM', false],
    ['06:60', false],
    ['24:59', false],
    ['06:30:60', false],
    ['06:60:10', false],
    ['25:30:10', false],
]);

it('validate times', function (string $context, bool $expectation) {
    $hour = fn (FluentBuilder $fluent) => $fluent->anyOf('01')->zeroOrOne()->digit()->or->find(2)->number(max: 3);
    $minutes = fn (FluentBuilder $fluent) => $fluent->number(max: 5)->digit();
    $am = fn (FluentBuilder $fluent) => $fluent->and(' ')->zeroOrOne()->anyOf('AaPp')->anyOf('Mm');

    $regex = Regex::for($context)
        ->startOfLine()
        ->not->group(fn (FluentBuilder $fluent) => $fluent->digit(), true)
        ->not->group(fn (FluentBuilder $fluent) => $fluent
            ->not->group($hour)
            ->and(':')
            ->not->group($minutes)
            ->not->group(fn (FluentBuilder $fluent) => $fluent->raw(':')->not->group($minutes))->zeroOrOne()
            ->not->group(callback: $am, lookahead: true)
            ->or
            ->not->group(
                fn (FluentBuilder $fluent) => $fluent->find(0)->zeroOrOne()->number(min: 1)->or->find(1)->number(max: 2)
            )
            ->and(':')
            ->not->group($minutes)
            ->not->group($am)->zeroOrOne()
        )
        ->endOfLine();

    expect($regex)
        ->toBeInstanceOf(FluentBuilder::class)
        ->get()->toBe('/^(?<!\d)(?:(?:[01]?\d|2[0-3]):(?:[0-5]\d)(?::(?:[0-5]\d))?(?! ?[AaPp][Mm])|(?:0?[1-9]|1[0-2]):(?:[0-5]\d)(?: ?[AaPp][Mm])?)$/')
        ->check()->toBe($expectation);
})->with('times');

describe('predefined TIME pattern', function () {
    beforeEach(function () {
        $this->builder = new FluentBuilder(patterns: [TimePattern::class]);
    });

    it('validates', function (string $context, bool $expectation) {
        $regex = $this->builder->setContext($context)->start()->time()->end();

        expect($regex->check())
            ->toBe($expectation);
    })->with('times');

    it('finds a time in text', function () {
        $context = "Meetings are set for 08:30 and 14:45:15. Lunch break at 12:00 PM. Early risers can join \n
        the 06:00 workout. Dinner is scheduled for 17:00PM. Conference calls at 11:00AM, 16:00, and 18:30.";

        $regex = $this->builder->setContext($context)->time();

        expect($regex->match())
            ->toHaveCount(7)
            ->toMatchArray([
                '08:30',
                '14:45:15',
                '12:00 PM',
                '06:00',
                '11:00AM',
                '16:00',
                '18:30',
            ]);
    });
});

it('check TimePattern', function () {
    $pattern = new TimePattern();

    expect($pattern)
        ->toBeInstanceOf(TimePattern::class)
        ->getName()->toBe('time')
        ->getPattern()->toBe('(?<!\d)(?:(?:[01]?\d|2[0-3]):(?:[0-5]\d)(?::(?:[0-5]\d))?(?! ?[AaPp][Mm])|(?:0?[1-9]|1[0-2]):(?:[0-5]\d)(?: ?[AaPp][Mm])?)');
});
