<?php

declare(strict_types=1);

use Rudashi\Contracts\PatternContract;
use Rudashi\FluentBuilder;
use Rudashi\Negate;
use Rudashi\Pattern;
use Rudashi\Token;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function fluentBuilder(bool $asSub = false): FluentBuilder
{
    return new FluentBuilder(isSub: $asSub);
}

function negation(): Negate
{
    return new Negate(fluentBuilder());
}

/**
 * @param  class-string<Rudashi\Contracts\PatternContract>  $pattern
 *
 * @return \Rudashi\FluentBuilder
 */
function fluentPattern(string $pattern): FluentBuilder
{
    return new FluentBuilder(patterns: [$pattern]);
}

function token(bool $asSub = false): Token
{
    return new Token(fluentBuilder(), $asSub);
}

function fakePattern(): Pattern
{
    return new class() extends Pattern implements PatternContract {
        protected static string $name = 'fake-pattern';

        public function getName(): string
        {
            return 'diff-name';
        }
    };
}
