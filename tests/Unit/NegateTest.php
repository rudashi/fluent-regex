<?php

declare(strict_types=1);

use Rudashi\Negate;

it('can create negation', function () {
    expect(new Negate(fluentBuilder()))
        ->toBeInstanceOf(Negate::class);
});
