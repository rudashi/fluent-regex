---
title:  Others
layout: page
next: Patterns
next-link: usage/patterns
previous: Quantifiers
previous-link: usage/quantifiers
---

# Others

Each method described in this section allows for unique manipulation of the pattern.

## `capture`

The `capture` method matches a pattern within a group and remembers the match.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->capture(
    fn (FluentBuilder $fluent) => $fluent->exactly('.')->letter()
);
 
// /(\.[a-zA-Z])/
```

## `maybe`

The `maybe` method matches a pattern within a group zero or one time.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->maybe(
    fn (FluentBuilder $fluent) => $fluent->exactly('.')->letter()
);
 
// /(\.[a-zA-Z])?/
```

## `oneOf`

The `oneOf` method alternatively matches any of the given characters.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->oneOf('a', 'b', '.');
 
// /a|b|\./
```

## `or`

The `or` method alternatively matches the pattern before and after using the method.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('a')->or()->exactly('b');
 
// /a|b/
```

Alternatively, you can use the `or` property, which works identically.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('a')->or->exactly('b');
 
// /a|b/
```