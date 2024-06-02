<?php

declare(strict_types=1);

use Rudashi\FluentBuilder;
use Rudashi\Patterns\MACAddressPattern;
use Rudashi\Regex;

dataset('macs', [
    ['01:02:03:04:ab:cd', true],
    ['01-02-03-04-ab-cd', true],
    ['01.02.03.04.ab.cd', true],
    ['49.33.0E.E0.B2.30', true],
    ['DD.54.D2.0D.3A.1C', true],
    ['D5.62.40.19.26.8A', true],
    ['', false],
    ['F2937E757902', false],
    ['B538.D6B0.CBF0', false],
    ['9D4F.B5DD.94C7', false],
    ['3D:F2:AC9:A6:B3:4F', false],
    ['3D:F2:C9:A6:B3:4F:00', false],
    [':F2:C9:A6:B3:4F', false],
    ['8C:1F:64:88:A', false],
    ['8C:1F:64:18:3', false],
    ['B8:A2:5D', false],
    ['087A52F9F2AB', false],
    ['E4D03DD64CDF', false],
    ['78FBF68497F1', false],
    ['aa.aa.bbbb.cccc', false],
    ['', false],

]);

it('validate macs', function (string $context, bool $expectation) {
    $regex = Regex::for($context)
        ->not->group(fn (FluentBuilder $fluent) => $fluent->anyOf(
            fn (FluentBuilder $fluent) => $fluent->number()->letter(last: 'f')->character('.:-')
        ), lookbehind: true)
        ->not->group(fn (FluentBuilder $fluent) => $fluent
            ->anyOf(fn (FluentBuilder $fluent) => $fluent->number()->letter(last: 'f'))
            ->times(2)
            ->anyOf(fn (FluentBuilder $fluent) => $fluent->character(':.-'))
        )->times(5)
        ->not->group(fn (FluentBuilder $fluent) => $fluent->anyOf(
            fn (FluentBuilder $fluent) => $fluent->number()->letter(last: 'f')->times(2)
        ))
        ->not->group(fn (FluentBuilder $fluent) => $fluent->anyOf(
            fn (FluentBuilder $fluent) => $fluent->number()->letter(last: 'f')->character(':-')
        ), lookahead: true);

    expect($regex)
        ->toBeInstanceOf(FluentBuilder::class)
        ->get()->toBe('/(?<![0-9a-fA-F.:-])(?:[0-9a-fA-F]{2}[:.-]){5}(?:[0-9a-fA-F]{2})(?![0-9a-fA-F:-])/')
        ->check()->toBe($expectation);
})->with('macs')
->todo();

describe('predefined MAC ADDRESS pattern', function () {
    beforeEach(function () {
        $this->builder = new FluentBuilder(patterns: [MACAddressPattern::class]);
    });

    it('validates', function (string $context, bool $expectation) {
        $regex = $this->builder->setContext($context)->start()->macAddress()->end();

        expect($regex->check())
            ->toBe($expectation);
    })->with('macs');

    it('finds a mac addresses in text', function () {
        $context = "Each device in the network has a unique MAC address, for example, 00:1A:2B:3C:4D:5E. MAC addresses 
        are used to identify devices in a local network. Another example of a MAC address is '66-77-88-99-AA-BB-66'. 
        Remember that MAC addresses can be written with colons or hyphens. Here is another example: '11:22:33:44:55:66'. 
        MAC addresses are assigned to network interfaces, which enables communication between devices. 
        The last example of a MAC address is CC-DD-EE-FF-00-11-aa.";

        $regex = $this->builder
            ->setContext($context)
            ->boundary()
            ->macAddress()
            ->boundary();

        expect($regex->match())
            ->toHaveCount(2)
            ->toMatchArray([
                '00:1A:2B:3C:4D:5E',
                '11:22:33:44:55:66',
            ]);
    });
});

it('check MACAddressPattern', function () {
    $pattern = new MACAddressPattern();

    expect($pattern)
        ->getName()->toBe('macAddress')
        ->getPattern()->toBe('(?<![0-9A-Fa-f.:-])(?:[0-9A-Fa-f]{2}[:.-]){5}(?:[0-9A-Fa-f]{2})(?![0-9A-Fa-f:-])');
});
