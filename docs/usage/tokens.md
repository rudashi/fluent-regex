---
title:  Tokens
layout: default
---

# Tokens

The `FluentBuilder` must be initialized before using tokens. Use one of the above [helper](helpers.md) methods to do this.  Tokens can be chained to create increasingly complex regular expressions.

### `anything`

The `anything` method matches any characters.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->anything();
 
// /.*/
```

### `character`

The `character` method literally matches the given character.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->character('-');
 
// /-/
```

### `and`

The `and` method is an alias for the `character` method.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->and('-');
 
// /-/
```

### `exactly`

The `exactly` method literally matches the given string.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('foo');
 
// /foo/
```

Special characters are additionally escaped.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('._%+-[]');
 
// /\._%\+\-\[\]/
```

### `find`

The `find` method is an alias for the `exactly` method.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->find('foo');
 
// /foo/
```

### `then`

The `then` method is an alias for the `exactly` method.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->then('foo');
 
// /foo/
```

### `letter`

The `letter` method matches any single letter, regardless of whether it is lowercase or uppercase.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->letter();
 
// /[a-zA-Z]/
```

### `letters`

The `letters` method matches all letters, regardless of whether it is lowercase or uppercase.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->letters();
 
// /[a-zA-Z]+/
```

### `lowerLetter`

The `lowerLetter` method matches any single lowercase letter.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->lowerLetter();
 
// /[a-z]/
```

### `lowerLetters`

The `lowerLetters` method matches all lowercase letters.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->lowerLetters();
 
// /[a-z]+/
```

### `number`

The `number` method matches any single number (equivalent to `\d`).

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->number();
 
// /[0-9]/
```

### `numbers`

The `numbers` method matches all numbers.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->numbers();
 
// /[0-9]+/
```

### `whitespace`

The `whitespace` method matches any whitespace character (equivalent to [\r\n\t\f\v ]).

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->whitespace();
 
// /\s/
```

### `nonWhitespace`

The `nonWhitespace` method matches any non-whitespace character.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->nonWhitespace();
 
// /\S/
```

### `digit`

The `digit` method matches any single digit (equivalent to [0-9]).

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->digit();
 
// /\d/
```

### `digits`

The `digits` method matches all digits.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->digits();
 
// /\d+/
```

### `nonDigit`

The `nonDigit` method matches any single character that is not a digit (equivalent to [^0-9]).

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->nonDigit();
 
// /\D/
```

### `nonDigits`

The `nonDigits` method matches all non-digit characters.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->nonDigits();
 
// /\D+/
```

### `word`

The `word` method matches any word character (equivalent to [a-zA-Z0-9_]).

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->word();
 
// /\w/
```

### `words`

The `words` method matches all words characters.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->words();
 
// /\w+/
```

### `anyOf`

The `anyOf` method matches any single characters present in the given string.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->anyOf('abc');
 
// /[abc]/
```

### `tab`

The `tab` method matches a tab character.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->tab();
 
// /\t/
```

### `carriageReturn`

The `carriageReturn` method matches a carriage return.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->carriageReturn();
 
// /\r/
```

### `newline`

The `newline` method matches a line-feed character (newline).

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->newline();
 
// /\r/
```

### `linebreak`

The `linebreak` method matches a carriage return or newline.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->linebreak();
 
// /\r|\n/
```

---

Continue to next section, for more information on how to use [Quantifiers →](quantifiers).