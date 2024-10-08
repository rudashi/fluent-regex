<?php

declare(strict_types=1);

use Rudashi\FluentBuilder;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Test\VarDumperTestTrait;
use Symfony\Component\VarDumper\VarDumper;

uses(VarDumperTestTrait::class);

const EXPECTED_DUMP = [
    FluentBuilder::class,
    '#context: ""\n',
    '#patterns: []\n',
    '#pattern: []\n',
    '#modifiers: []\n',
    '#anchors: Rudashi\Anchors',
    '-prefix: []\n',
    '-suffix: []\n',
    '-builder: Rudashi\FluentBuilder',
    '-delimiter: "/"\n',
    '-isSub: false\n',
];

beforeEach(function () {
    $cloner = new VarCloner();
    $dumper = new CliDumper('php://output');
    VarDumper::setHandler(function ($var) use ($cloner, $dumper) {
        $dumper->dump($cloner->cloneVar($var));
    });

    $this->builder = new FluentBuilder();
});

it('can use `dump`', function () {
    ob_start();

    $this->builder->dump();
    $dump = ob_get_clean();

    // @phpstan-ignore-next-line
    expect($this->getDump($dump))
        ->toBeString()
        ->toContain(...EXPECTED_DUMP);
});

it('can use `dump` with argument', function () {
    $var1 = 'Lorem ipsum';

    ob_start();
    $this->builder->dump($var1);
    $dump = ob_get_clean();

    // @phpstan-ignore-next-line
    expect($this->getDump($dump))
        ->toContain(
            '}\n
"Lorem ipsum"\n
"""',
            ...EXPECTED_DUMP,
        );
});

it('can use `dump` with arguments', function () {
    $var1 = 'Lorem';
    $var2 = 'ipsum';
    $var3 = 'dolor';

    ob_start();
    $this->builder->dump($var1, $var2, $var3);
    $dump = ob_get_clean();

    // @phpstan-ignore-next-line
    expect($this->getDump($dump))
        ->toContain(
            '}\n
"Lorem"\n
"ipsum"\n
"dolor"\n
"""',
            ...EXPECTED_DUMP,
        );
});
