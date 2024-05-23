<?php

declare(strict_types=1);

use Rudashi\FluentBuilder;

/**
 * Built-in methods
 */
describe('FluentBuilder', function () {
    it('can add to `pattern` value', function () {
        $regex = fluentBuilder()->pushToPattern('test');

        expect($regex->get())
            ->toBe('/test/');
    });

    it('can add a `character` token', function () {
        $regex = fluentBuilder()->character('._%+-');

        expect($regex->get())
            ->toBe('/._%+-/');
    });

    it('can add a `and` token', function () {
        $regex = fluentBuilder()->and('._%+-');

        expect($regex->get())
            ->toBe('/._%+-/');
    });

    it('can add a `exactly` token', function () {
        $regex = fluentBuilder()->exactly('foo bar');

        expect($regex->get())
            ->toBe('/foo bar/');
    });

    it('can add a `find` token', function () {
        $regex = fluentBuilder()->find('foo bar');

        expect($regex->get())
            ->toBe('/foo bar/');
    });

    it('can add a `then` token', function () {
        $regex = fluentBuilder()->then('foo bar');

        expect($regex->get())
            ->toBe('/foo bar/');
    });

    it('can add a numeric `exactly` token', function () {
        $regex = fluentBuilder()->exactly(41);

        expect($regex->get())
            ->toBe('/41/');
    });

    it('can add sanitized `exactly` token', function () {
        $regex = fluentBuilder()->exactly('._%+-[]');

        expect($regex->get())
            ->toBe('/\._%\+\-\[\]/');
    });

    it('can add a `letter` token', function () {
        $regex = fluentBuilder()->letter();

        expect($regex->get())
            ->toBe('/[a-zA-Z]/');
    });

    it('can add a `lowerLetter` token', function () {
        $regex = fluentBuilder()->lowerLetter();

        expect($regex->get())
            ->toBe('/[a-z]/');
    });

    it('can add a `number` token', function () {
        $regex = fluentBuilder()->number();

        expect($regex->get())
            ->toBe('/[0-9]/');
    });

    it('can add a `numbers` token', function () {
        $regex = fluentBuilder()->numbers();

        expect($regex->get())
            ->toBe('/[0-9]+/');
    });

    it('can add a `whitespaces`', function () {
        $regex = fluentBuilder()->whitespace();

        expect($regex->get())
            ->toBe('/\s/');
    });

    it('can add a `non whitespaces`', function () {
        $regex = fluentBuilder()->nonWhitespace();

        expect($regex->get())
            ->toBe('/\S/');
    });

    it('can add a `digit`', function () {
        $regex = fluentBuilder()->digit();

        expect($regex->get())
            ->toBe('/\d/');
    });

    it('can add a `digits`', function () {
        $regex = fluentBuilder()->digits();

        expect($regex->get())
            ->toBe('/\d+/');
    });

    it('can add a `nonDigit`', function () {
        $regex = fluentBuilder()->nonDigit();

        expect($regex->get())
            ->toBe('/\D/');
    });

    it('can add a `nonDigits`', function () {
        $regex = fluentBuilder()->nonDigits();

        expect($regex->get())
            ->toBe('/\D+/');
    });

    it('can add a `word`', function () {
        $regex = fluentBuilder()->word();

        expect($regex->get())
            ->toBe('/\w/');
    });

    it('can add a `words`', function () {
        $regex = fluentBuilder()->words();

        expect($regex->get())
            ->toBe('/\w+/');
    });

    it('can add `tab` character', function () {
        $regex = fluentBuilder()->tab();

        expect($regex->get())
            ->toBe('/\t/');
    });

    it('can add `carriageReturn`', function () {
        $regex = fluentBuilder()->carriageReturn();

        expect($regex->get())
            ->toBe('/\r/');
    });

    it('can add `newline`', function () {
        $regex = fluentBuilder()->newline();

        expect($regex->get())
            ->toBe('/\n/');
    });

    it('can add `linebreak`', function () {
        $regex = fluentBuilder()->linebreak();

        expect($regex->get())
            ->toBe('/\r|\n/');
    });

    it('can add a `anyOf`', function () {
        $regex = fluentBuilder()->anyOf('abc.@-_');

        expect($regex->get())
            ->toBe('/[abc\.@\-_]/');
    });

    it('can chain pattern inside `anyOf', function () {
        $regex = fluentBuilder()->start()->anyOf(
            fn (FluentBuilder $builder) => $builder->letter()->number()->character('._%+-')
        )->end();

        expect($regex->get())
            ->toBe('/^[a-zA-Z0-9._%+-]$/');
    });

    it('can add a `boundary`', function () {
        $regex = fluentBuilder()->boundary();

        expect($regex->get())
            ->toBe('/\b/');
    });

    it('can add a `nonBoundary`', function () {
        $regex = fluentBuilder()->nonBoundary();

        expect($regex->get())
            ->toBe('/\B/');
    });
});

/**
 * Delegate methods
 */
describe('Tokens', function () {
    describe('letter', function () {
        it('can add a `letter` token', function () {
            $regex = token()->letter();

            expect($regex->get())
                ->toBe('/[a-zA-Z]/');
        });

        it('can add a pure `letter` token', function () {
            $regex = token(true)->letter();

            expect($regex->get())
                ->toBe('/a-zA-Z/');
        });

        it('can change the first `letter` token', function () {
            $regex = token()->letter(first: 'b');

            expect($regex->get())
                ->toBe('/[b-zB-Z]/');
        });

        it('can change the last `letter` token', function () {
            $regex = token()->letter(last: 'f');

            expect($regex->get())
                ->toBe('/[a-fA-F]/');
        });

        it('threw an exception when `first` letter is not between [a-y] for token `letter`', function () {
            expect(fn () => token()->letter(first: 'z'))
                ->toThrow(
                    exception: LogicException::class,
                    exceptionMessage: 'The first letter must be between [a-y].'
                );
        });

        it('threw an exception when `last` letter is not between [b-z] for token `letter`', function () {
            expect(fn () => token()->letter(last: 'a'))
                ->toThrow(
                    exception: LogicException::class,
                    exceptionMessage: 'The last letter must be between [b-z].'
                );
        });
    });

    describe('lowerLetter', function () {
        it('can add a `lowerLetter` token', function () {
            $regex = token()->lowerLetter();

            expect($regex->get())
                ->toBe('/[a-z]/');
        });

        it('can add a pure `lowerLetter` token', function () {
            $regex = token(true)->lowerLetter();

            expect($regex->get())
                ->toBe('/a-z/');
        });

        it('can change the first `lowerLetter` token', function () {
            $regex = token()->lowerLetter(first: 'b');

            expect($regex->get())
                ->toBe('/[b-z]/');
        });

        it('can change the last `lowerLetter` token', function () {
            $regex = token()->lowerLetter(last: 'f');

            expect($regex->get())
                ->toBe('/[a-f]/');
        });

        it('threw an exception when `first` letter is not between [a-y] for token `letter`', function () {
            expect(fn () => token()->lowerLetter(first: 'z'))
                ->toThrow(
                    exception: LogicException::class,
                    exceptionMessage: 'The first letter must be between [a-y].'
                );
        });

        it('threw an exception when `last` letter is not between [b-z] for token `letter`', function () {
            expect(fn () => token()->lowerLetter(last: 'a'))
                ->toThrow(
                    exception: LogicException::class,
                    exceptionMessage: 'The last letter must be between [b-z].'
                );
        });
    });

    describe('number', function () {
        it('can add a `number` token', function () {
            $regex = token()->number();

            expect($regex->get())
                ->toBe('/[0-9]/');
        });

        it('can add a pure `number` token', function () {
            $regex = token(true)->number();

            expect($regex->get())
                ->toBe('/0-9/');
        });

        it('can change the minimum `number` token', function () {
            $regex = token()->number(min: 3);

            expect($regex->get())
                ->toBe('/[3-9]/');
        });

        it('can change the maximum `number` token', function () {
            $regex = token()->number(max: 3);

            expect($regex->get())
                ->toBe('/[0-3]/');
        });

        it('threw an exception when `minimum` is less than 0 for token `number`', function () {
            expect(fn () => token()->number(min: -1))
                ->toThrow(
                    exception: LogicException::class,
                    exceptionMessage: 'The number range must be between [0-9].'
                );
        });

        it('threw an exception when `maximum` is greater than 9 for token `number`', function () {
            expect(fn () => token()->number(max: 10))
                ->toThrow(
                    exception: LogicException::class,
                    exceptionMessage: 'The number range must be between [0-9].'
                );
        });
    });
});