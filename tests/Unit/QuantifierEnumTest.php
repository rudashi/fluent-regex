<?php

declare(strict_types=1);

use Rudashi\Quantifier;

it('checks the existence of an enum', function () {
    expect(enum_exists(Quantifier::class))
        ->toBeTrue();
});

it('can check Flag Enum type', function () {
    expect(Quantifier::ZERO_OR_ONE)
        ->toBeInstanceOf(BackedEnum::class)
        ->toMatchArray([
            'value' => '?',
            'name' => 'ZERO_OR_ONE',
        ]);
});

it('checks cases', function () {
    expect(Quantifier::cases())
        ->toBeArray()
        ->toHaveCount(3);
});
