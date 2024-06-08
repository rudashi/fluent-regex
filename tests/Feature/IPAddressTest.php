<?php

declare(strict_types=1);

use Rudashi\FluentBuilder;
use Rudashi\Patterns\IPAddressPattern;
use Rudashi\Regex;

dataset('ips', [
    ['127.0.0.1', true],
    ['192.168.1.1', true],
    ['192.168.1.255', true],
    ['255.255.255.255', true],
    ['10.0.0.1', true],
    ['0.0.0.0', true],
    ['10.0.0.999', false],
    ['300.255.255.255', false],
    ['192.168.1.256,', false],
    ['192.168.1.1.1,', false],
    ['30.168.1.255.1', false],
    ['127.1', false],
    ['-1.2.3.4', false],
    ['1.1.1.1.', false],
    ['4...4', false],
    ['1.1.1.01', false],
    ['', false],
]);

it('validate ip address', function (string $context, bool $expectation) {
    $regex = Regex::for($context)
        ->start()
        ->group(fn (FluentBuilder $fluent) => $fluent
            ->group(fn (FluentBuilder $fluent) => $fluent
                ->find(25)
                ->number(0, 5)
                ->or->group(fn (FluentBuilder $fluent) => $fluent
                    ->find(2)->number(0, 4)
                    ->or->find(1)->digit()
                    ->or->number(1)->or()
                )->digit()
            )->then('.')->character('?')->boundary()
        )
        ->times(4)
        ->end();

    expect($regex)
        ->toBeInstanceOf(FluentBuilder::class)
        ->get()->toBe('/^((25[0-5]|(2[0-4]|1\d|[1-9]|)\d)\.?\b){4}$/')
        ->check()->toBe($expectation);
})->with('ips');

describe('predefined IP ADDRESS pattern', function () {
    beforeEach(function () {
        $this->builder = new FluentBuilder(patterns: [IPAddressPattern::class]);
    });

    it('validates', function (string $context, bool $expectation) {
        $regex = $this->builder->addContext($context)->start()->ipAddress()->end();

        expect($regex->check())
            ->toBe($expectation);
    })->with('ips');

    it('finds an ip address in text', function () {
        $context = "Yesterday, I noticed suspicious activities on the address 203.0.113.50. Additionally, the network 
        traffic from 198.51.100.23 was unusual. Our firewall recorded an attempt to connect to the address 192.0.2.16. 
        Finally, the device with the address 172.20.10.5 exhibited unknown behavior!";

        $regex = $this->builder->addContext($context)->ipAddress();

        expect($regex->match())
            ->toHaveCount(4)
            ->toMatchArray([
                '203.0.113.50',
                '198.51.100.23',
                '192.0.2.16',
                '172.20.10.5',
            ]);
    });
});

it('check IPAddressPattern', function () {
    $pattern = new IPAddressPattern();

    expect($pattern)
        ->toBeInstanceOf(IPAddressPattern::class)
        ->getName()->toBe('ipAddress')
        ->getPattern()->toBe('((25[0-5]|(2[0-4]|1\d|[1-9]|)\d)\.?\b){4}');
});
