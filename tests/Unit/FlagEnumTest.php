<?php

declare(strict_types=1);

use Rudashi\Flag;

it('checks the existence of an enum', function () {
    expect(enum_exists(Flag::class))
        ->toBeTrue();
});

it('can check Flag Enum type', function () {
    expect(Flag::INSENSITIVE)
        ->toBeInstanceOf(BackedEnum::class)
        ->toMatchArray([
            'value' => 'i',
            'name' => 'INSENSITIVE',
        ]);
});

it('checks cases', function () {
    expect(Flag::cases())
        ->toBeArray()
        ->toHaveCount(5);
});
