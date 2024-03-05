<?php

declare(strict_types=1);

it('can add context to the builder', function () {
    $regex = fluentBuilder()->setContext('test');

    try {
        $reflectProperty = (new ReflectionClass($regex))->getProperty('context')->getValue($regex);

        expect($reflectProperty)->toBe('test');
    } catch (ReflectionException $e) {
        $this->markTestSkipped($e->getMessage());
    }
});

/**
 * Returning results
 */
it('can return a string pattern', function () {
    $regex = fluentBuilder();

    expect($regex->get())
        ->toBe('//');
});
