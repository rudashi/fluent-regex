<?php

declare(strict_types=1);

use Rudashi\FluentBuilder;
use Rudashi\Patterns\CreditCardPattern;
use Rudashi\Regex;

dataset('cards', [
    // Visa
    ['4003684453673543', true],
    ['4202822558355520', true],
    ['4602752114566714', true],
    ['4150245074055345', true],
    ['4133404685033272', true],

    // Master Card
    ['5224442023233060', true],
    ['5544633554427856', true],
    ['5392962341424824', true],
    ['5334182038337624', true],
    ['5598674007228264', true],
    ['5234745313053503', true],
    ['5491782051421673', true],

    // Others
    ['6501650300640565', false],
    ['6557812233316084', false],
    ['379974458315545', false],
    ['378752000748061', false],
    ['5653842245367630', false],
    ['6398843727635252', false],
    ['6204256731847751', false],
]);

it('validate credit card', function (string $context, bool $expectation) {
    $regex = Regex::for($context)
        ->start()
        ->not->capture(
            fn (FluentBuilder $fluent) => $fluent->find(4)
                ->number()
                ->times(12)
                ->not->capture(fn (FluentBuilder $fluent) => $fluent->number()->times(3))->zeroOrOne()
                ->or->find(5)->number(1, 5)->number()->times(14)
        )
        ->end();

    expect($regex)
        ->toBeInstanceOf(FluentBuilder::class)
        ->get()->toBe('/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14})$/')
        ->check()->toBe($expectation);
})->with('cards');

describe('predefined CARDS pattern', function () {
    beforeEach(function () {
        $this->builder = new FluentBuilder(patterns: [CreditCardPattern::class]);
    });

    it('validates', function (string $context, bool $expectation) {
        $regex = $this->builder->addContext($context)->start()->{'credit-card'}()->end();

        expect($regex->check())
            ->toBe($expectation);
    })->with('cards');

    it('use alias', function (string $context, bool $expectation) {
        $regex = $this->builder->addContext($context)->start()->creditCard()->end();

        expect($regex->check())
            ->toBe($expectation);
    })->with('cards');

    it('finds a credit cards in text', function () {
        $context = "Please ensure to update your payment information as soon as possible. Your recent purchases with \n
        card number 4482483806051485 and 5306940803297966 need immediate attention to avoid any disruption \n
        to your services. Thank you for your cooperation.";

        $regex = $this->builder->addContext($context)->creditCard();

        expect($regex->match())
            ->toHaveCount(2)
            ->toMatchArray([
                '4482483806051485',
                '5306940803297966',
            ]);
    });
});

it('check CreditCardPattern', function () {
    $pattern = new CreditCardPattern();

    expect($pattern)
        ->toBeInstanceOf(CreditCardPattern::class)
        ->getName()->toBe('credit-card')
        ->getPattern()->toBe('(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14})');
});
