<?php

declare(strict_types=1);

use Rudashi\FluentBuilder;
use Rudashi\Patterns\IPv6AddressPattern;
use Rudashi\Regex;

dataset('ips v6', [
    ['2001:0db8:85a3:0000:0000:8a2e:0370:7334', true],
    ['FE80:0000:0000:0000:0202:B3FF:FE1E:8329', true],
    ['2001:0db8:0001:0000:0000:0ab9:C0A8:0102', true],
    ['2001:db8:3333:4444:CCCC:DDDD:EEEE:FFFF', true],
    ['::1234:5678', true],
    ['::1', true],
    ['2001:db8::', true],
    ['2001:db8::1234:5678', true],
    ['', false],
    ['192.168.1.1', false],
    ['test:test:test:test:test:test:test:test', false],
    ['2001.0db8.85a3.0000.0000.8a2e.0370.7334,', false],
    ['GE80:0000:0000:0000:0202:B3FF:FE1E:8329,', false],
    ['::GE80:0000:0000:0000:0202:B3FF:FE1E:8329,', false],
    ['GE80:0000:0000:0000:0202:B3FF:FE1E:8329::,', false],
    ['GE80:0000:0000::::0202:B3FF:FE1E:8329,', false],
    ['2001:0db8:0001:0000:0000:0ab9:G0A8:0102', false],
]);

it('validate ip address', function (string $context, bool $expectation) {
    $anyOf = fn (FluentBuilder $fluent) => $fluent->number()->letter(last: 'f');
    $group = fn (FluentBuilder $fluent) => $fluent->anyOf($anyOf)->between(1, 4)->character(':');
    $subGroup = fn (FluentBuilder $fluent) => $fluent->character(':')->anyOf($anyOf)->between(1, 4);

    $regex = Regex::for($context)
        ->start()
        ->group(fn (FluentBuilder $fluent) => $fluent
            ->group($group)->between(7, 7)->anyOf($anyOf)->between(1, 4)
            ->or
            ->group($group)->between(1, 7)->character(':')
            ->or
            ->group($group)->between(1, 6)->character(':')->anyOf($anyOf)->between(1, 4)
            ->or
            ->group($group)->between(1, 5)->group($subGroup)->between(1, 2)
            ->or
            ->group($group)->between(1, 4)->group($subGroup)->between(1, 3)
            ->or
            ->group($group)->between(1, 3)->group($subGroup)->between(1, 4)
            ->or
            ->group($group)->between(1, 2)->group($subGroup)->between(1, 5)
            ->or
            ->anyOf($anyOf)->between(1, 4)->character(':')
            ->group(fn (FluentBuilder $fluent) => $fluent->group($subGroup)->between(1, 6))
            ->or
            ->character(':')
            ->group(fn (FluentBuilder $fluent) => $fluent->group($subGroup)->between(1, 7)->or->character(':'))
        )
        ->end();

    expect($regex)
        ->toBeInstanceOf(FluentBuilder::class)
        ->get()->toBe('/^(([0-9a-fA-F]{1,4}:){7,7}[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,7}:|([0-9a-fA-F]{1,4}:){1,6}:[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,5}(:[0-9a-fA-F]{1,4}){1,2}|([0-9a-fA-F]{1,4}:){1,4}(:[0-9a-fA-F]{1,4}){1,3}|([0-9a-fA-F]{1,4}:){1,3}(:[0-9a-fA-F]{1,4}){1,4}|([0-9a-fA-F]{1,4}:){1,2}(:[0-9a-fA-F]{1,4}){1,5}|[0-9a-fA-F]{1,4}:((:[0-9a-fA-F]{1,4}){1,6})|:((:[0-9a-fA-F]{1,4}){1,7}|:))$/')
        ->check()->toBe($expectation);
})->with('ips v6');

describe('predefined IP ADDRESS pattern', function () {
    beforeEach(function () {
        $this->builder = new FluentBuilder(patterns: [IPv6AddressPattern::class]);
    });

    it('validates', function (string $context, bool $expectation) {
        $regex = $this->builder->addContext($context)->start()->ipv6()->end();

        expect($regex->check())
            ->toBe($expectation);
    })->with('ips v6');

    it('finds an ipv6 address s in text', function () {
        $context = "I visited a website with the IPv6 address: 2001:0db8:85a3:0000:8a2e:0370:7334, which \n
        contained many interesting articles. Another site with the address 2001:0db8:0000:0042:0000:8a2e:0370:7334 \n
        I found while browsing tech news. My friend uses a server with the address fe80:0000:0000:0000:1ff:fe23:4567:890a in \n
        his home network. On my laptop, I configured the IPv6 address: 2001:0db8:1234:0000:0000:0000:0000:0001.";

        $regex = $this->builder->addContext($context)->ipv6();

        expect($regex->match())
            ->toHaveCount(3)
            ->toMatchArray([
                '2001:0db8:0000:0042:0000:8a2e:0370:7334',
                'fe80:0000:0000:0000:1ff:fe23:4567:890a',
                '2001:0db8:1234:0000:0000:0000:0000:0001',
            ]);
    });
});

it('check IPv6AddressPattern', function () {
    $pattern = new IPv6AddressPattern();

    expect($pattern)
        ->toBeInstanceOf(IPv6AddressPattern::class)
        ->getName()->toBe('ipv6')
        ->getPattern()->toBe('(([0-9a-fA-F]{1,4}:){7,7}[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,7}:|([0-9a-fA-F]{1,4}:){1,6}:[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,5}(:[0-9a-fA-F]{1,4}){1,2}|([0-9a-fA-F]{1,4}:){1,4}(:[0-9a-fA-F]{1,4}){1,3}|([0-9a-fA-F]{1,4}:){1,3}(:[0-9a-fA-F]{1,4}){1,4}|([0-9a-fA-F]{1,4}:){1,2}(:[0-9a-fA-F]{1,4}){1,5}|[0-9a-fA-F]{1,4}:((:[0-9a-fA-F]{1,4}){1,6})|:((:[0-9a-fA-F]{1,4}){1,7}|:))');
});
