<?php

declare(strict_types=1);

use Rudashi\FluentBuilder;
use Rudashi\Patterns\UrlPattern;
use Rudashi\Regex;

dataset('urls', [
    ['http://github.com', true],
    ['http://www.github.com', true],
    ['https://github.com', true],
    ['https://www.github.com', true],
    ['https://github.com/blog', true],
    ['https://foobar.github.co', true],
    ['https://www.example.com', true],
    ['http://social.example.org', true],
    ['http://social.example.org/profile/name', true],
    ['http://social.example.org/profil-asd4e/name', true],
    ['http://4-social.example.org', true],
    ['http://social.example.com.pl', true],
    ['https://www.example.com/profile', true],
    ['', false],
    ['www.creative-business.com', false],
    ['http://-example.com', false],
    ['http://example-.com', false],
    [' http://github.com', false],
    ['foo', false],
    ['htps://github.com', false],
    ['http:/github.com', false],
    ['https://github.com /blog', false],
    ['https://.com', false],
    ['http://.com', false],
]);

it('validate urls', function (string $context, bool $expectation) {
    $regex = Regex::for($context)
        ->start()
        ->exactly('https')->zeroOrOne()
        ->then("://")
        ->not->character('-')
        ->anyOf(
            fn (FluentBuilder $fluent) => $fluent->lowerLetter()->digit()->character('.-')
        )->oneOrMore()
        ->not->character('-')
        ->then('.')
        ->lowerLetter()->min(2)
        ->maybe(fn (FluentBuilder $fluent) => $fluent->exactly('/')->anyOf(
            fn (FluentBuilder $fluent) => $fluent->lowerLetter()->digit()->exactly('/')->character('-')
        )->zeroOrMore())
        ->utf8()
        ->end();

    expect($regex)
        ->toBeInstanceOf(FluentBuilder::class)
        ->get()->toBe('/^https?\:\/\/[^-][a-z\d.-]+[^-]\.[a-z]{2,}(\/[a-z\d\/-]*)?$/u')
        ->check()->toBe($expectation);
})->with('urls');

describe('predefined URL pattern', function () {
    beforeEach(function () {
        $this->builder = new FluentBuilder(patterns: [UrlPattern::class]);
    });

    it('validates', function (string $context, bool $expectation) {
        $regex = $this->builder->addContext($context)->start()->url()->end();

        expect($regex->check())
            ->toBe($expectation);
    })->with('urls');

    it('finds an urls in text', function () {
        $context = "Find the best business solutions at http://develop-yourself.com. Need some inspiration? Visit \n
        www.creative-business.com. And if you're looking for entertainment, check out https://creative-hobbies.com!";

        $regex = $this->builder->addContext($context)->url();

        expect($regex->match())
            ->toHaveCount(2)
            ->toMatchArray([
                'http://develop-yourself.com',
                'https://creative-hobbies.com',
            ]);
    });
});

it('check UrlPattern', function () {
    $pattern = new UrlPattern();

    expect($pattern)
        ->toBeInstanceOf(UrlPattern::class)
        ->getName()->toBe('url')
        ->getPattern()->toBe('https?\:\/\/[^-][a-z\d.-]+[^-]\.[a-z]{2,}(\/[a-z\d\/-]*)?');
});
