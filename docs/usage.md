---
title:  Usage
layout: default
---

# Usage

You can start creating your regex by using `Regex::build()`. The `build()` method is used every time you want to create a pattern.

## Available Methods

### Helpers methods

- [`build`](#build)
- [`for`](#for)
- [`start`](#start)
- [`startOfLine`](#startofline)

### Tokens methods

- [`character`](#character)
- [`exactly`](#exactly)
- [`letter`](#letter)
- [`letters`](#letters)
- [`lowerLetter`](#lowerletter)
- [`lowerLetters`](#lowerletters)
- [`number`](#number)
- [`numbers`](#numbers)
- [`whitespace`](#whitespace)
- [`nonWhitespace`](#nonwhitespace)
- [`digit`](#digit)
- [`digits`](#digits)
- [`nonDigit`](#nondigit)
- [`nonDigits`](#nondigits)
- [`word`](#word)
- [`words`](#words)
- [`anyOf`](#anyof)
- [`oneOf`](#oneof)

### Quantifiers methods

- [`zeroOrOne`](#zeroorone)
- [`zeroOrMore`](#zeroormore)
- [`oneOrMore`](#oneormore)
- [`times`](#times)
- [`min`](#min)
- [`between`](#between)

### Other methods

- [`or`](#or)

### Patterns methods

## Helpers

#### `build`

The `build` method creates a new `Rudashi\FluentBuilder` instance.

```php
use Rudashi\Regex;
 
$builder = Regex::build();
 
// Rudashi\FluentBuilder
```

#### `for`

The `for` method adds context to `Rudashi\FluentBuilder` instance.

```php
use Rudashi\Regex;
 
$builder = Regex::for('Hello, world!');
 
// Rudashi\FluentBuilder
```

#### `start`

The `start` method adds start flag.

```php
use Rudashi\Regex;
 
$pattern = Regex::start();
 
// /^/
```

#### `startOfLine`

The `startOfLine` method is equivalent to the `Regex::start` method.

```php
use Rudashi\Regex;
 
$pattern = Regex::startOfLine();
 
// /^/
```

## Tokens

The `FluentBuilder` must be initialized before using tokens. Use one of the above helper methods to do this.
Tokens can be chained to create increasingly complex regular expressions.

#### `character`

The `character` method literally matches the given character.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->character('-');
 
// /-/
```

#### `exactly`

The `exactly` method literally matches the given string.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('foo');
 
// /foo/
```

#### `letter`

The `letter` method matches any single letter, regardless of whether it is lowercase or uppercase.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->letter();
 
// /[a-zA-Z]/
```

#### `letters`

The `letters` method matches all letters, regardless of whether it is lowercase or uppercase.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->letters();
 
// /[a-zA-Z]+/
```

#### `lowerLetter`

The `lowerLetter` method matches any single lowercase letter.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->lowerLetter();
 
// /[a-z]/
```

#### `lowerLetters`

The `lowerLetters` method matches all lowercase letters.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->lowerLetters();
 
// /[a-z]+/
```

#### `number`

The `number` method matches any single number (equivalent to `\d`).

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->number();
 
// /[0-9]/
```

#### `numbers`

The `numbers` method matches all numbers.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->numbers();
 
// /[0-9]+/
```

#### `whitespace`

The `whitespace` method matches any whitespace character (equivalent to [\r\n\t\f\v ]).

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->whitespace();
 
// /\s/
```

#### `nonWhitespace`

The `nonWhitespace` method matches any non-whitespace character.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->nonWhitespace();
 
// /\S/
```

#### `digit`

The `digit` method matches any single digit (equivalent to [0-9]).

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->digit();
 
// /\d/
```

#### `digits`

The `digits` method matches all digits.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->digits();
 
// /\d+/
```

#### `nonDigit`

The `nonDigit` method matches any single character that is not a digit (equivalent to [^0-9]).

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->nonDigit();
 
// /\D/
```

#### `nonDigits`

The `nonDigits` method matches all non-digit characters.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->nonDigits();
 
// /\D+/
```

#### `word`

The `word` method matches any word character (equivalent to [a-zA-Z0-9_]).

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->word();
 
// /\w/
```

#### `words`

The `words` method matches all words characters.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->words();
 
// /\w+/
```

#### `anyOf`

The `anyOf` method matches any single characters present in the given string.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->anyOf('abc');
 
// /[abc]/
```

#### `oneOf`

The `oneOf` method alternatively matches any of the given characters.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->oneOf('a', 'b', '.');
 
// /a|b|\./
```

## Quantifiers

#### `zeroOrOne`

The `zeroOrOne` method matches the previous token zero or one time.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('a')->zeroOrOne();
 
// /a?/
```

#### `zeroOrMore`

The `zeroOrMore` method matches the previous token between zero and an unlimited number of times.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('a')->zeroOrMore();
 
// /a*/
```

#### `oneOrMore`

The `oneOrMore` method matches the previous token once or an unlimited number of times.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('a')->oneOrMore();
 
// /a+/
```

#### `times`

The `times` method matches the previous token a specified number of times.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('a')->times(1);
 
// /a{1}/
```

#### `min`

The `min` method matches the previous token between a specified number to an unlimited number of times.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('a')->min(1);
 
// /a{1,}/
```

#### `between`

The `between` method matches the previous token between a specified numbers of times.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('a')->between(1, 3);
 
// /a{1,3}/
```

Additionally, if you omit the second argument, the method behaves identically to `min`.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('a')->between(1);
 
// /a{1,}/
```

## Others

#### `or`

The `or` method alternatively matches the pattern before and after using the method.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('a')->or()->exactly('b');
 
// /a|b/
```

## Patterns

---

Once you have learned how to write patterns, the next section is [Advance usage →](advance).