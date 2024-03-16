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

- [`exactly`](#exactly)
- [`letter`](#letter)
- [`letters`](#letters)
- [`lowerLetter`](#lowerletter)
- [`lowerLetters`](#lowerletters)
- [`whitespace`](#whitespace)
- [`nonWhitespace`](#nonwhitespace)
- [`digit`](#digit)
- [`digits`](#digits)
- [`nonDigit`](#nondigit)
- [`nonDigits`](#nondigits)
- [`word`](#word)
- [`words`](#words)
- [`any`](#any)

### Quantifiers methods

### Negation methods

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

#### `exactly`

The `exactly` method matches a single character present in the given string.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('foo');
 
// /[foo]/
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

#### `any`

The `any` method matches any single characters present in the given string.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->any('abc');
 
// /[abc]/
```

## Quantifiers

## Negation

## Patterns

---

Once you have learned how to write patterns, the next section is [Advance usage →](advance).