<?php

declare(strict_types=1);

use Rudashi\FluentBuilder;
use Rudashi\Patterns\EmailPattern;
use Rudashi\Regex;

dataset('emails', [
    ['corsec@kimiafarma.co.id', true],
    ['kangoedin@gmail.com', true],
    ['boss@id.abbott', true],
    ['firstname@gmail.com', true],
    ['john@doe.pl', true],
    ['frist1991@gmail.com', true],
    ['john.doe@tot.com', true],
    ['john-doe@tot.com', true],
    ['john.doe@tot.com.pl', true],
    ['firstname.@gmail.com', false],
    ['firstname..lastname@gmail.com', false],
    ['firstname#lastname@gmail.com', false],
    ['first name@gmai.com', false],
    ['.fristname@gmail.com', false],
    ['vorys@zfo', false],
    ['1bory@zfo', false],
]);

it('validate email', function (string $context, bool $expectation) {
    $regex = Regex::for($context)
        ->start()
        ->words()
        ->not->capture(fn (FluentBuilder $fluent) => $fluent->anyOf('.-')->words())
        ->zeroOrMore()
        ->then('@')
        ->capture(
            fn (FluentBuilder $fluent) => $fluent->anyOf(
                fn (FluentBuilder $fluent) => $fluent->word()->and('-')
            )->oneOrMore()->then('.')
        )
        ->oneOrMore()
        ->anyOf(fn (FluentBuilder $fluent) => $fluent->word()->and('-'))
        ->between(2)
        ->end();

    expect($regex)
        ->toBeInstanceOf(FluentBuilder::class)
        ->get()->toBe('/^\w+(?:[\.\-]\w+)*@([\w-]+\.)+[\w-]{2,}$/')
        ->check()->toBe($expectation);
})->with('emails');

describe('predefined EMAIL pattern', function () {
    beforeEach(function () {
        $this->builder = new FluentBuilder(patterns: [EmailPattern::class]);
    });

    it('validates', function (string $context, bool $expectation) {
        $regex = $this->builder->setContext($context)->start()->email()->end();

        expect($regex->check())
            ->toBe($expectation);
    })->with('emails');

    it('finds an email in text', function () {
        $context = "Hello! For inquiries about our services, feel free to reach out. Our support team can be \n
        reached at support@company.com. For business queries, contact us at business@company.com. Additionally, \n
        our marketing department is available at marketing@company.com. We assure you that each inquiry will be \n
        addressed promptly and with the utmost care. Thank you for your trust, and we look forward to \n
        collaborating with you.";

        $regex = $this->builder->setContext($context)->email();

        expect($regex->match())
            ->toHaveCount(3)
            ->toMatchArray([
                'support@company.com',
                'business@company.com',
                'marketing@company.com',
            ]);
    });
});

it('check EmailPattern', function () {
    $pattern = new EmailPattern();

    expect($pattern)
        ->getName()->toBe('email')
        ->getPattern()->toBe('\w+(?:[\.\-]\w+)*@([\w-]+\.)+[\w-]{2,}');
});
