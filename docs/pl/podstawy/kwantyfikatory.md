---
title: Kwantyfikatory
layout: pl-page
next: Inne
next-link: podstawy/inne
previous: Dodatkowe metody
previous-link: podstawy/dodatkowe-metody
---

## Kwantyfikatory

Quantifiers specify how many instances of a character, group or character must be present in the subject for a match to be found.

### `zeroOrOne`

The `zeroOrOne` method matches the previous token zero or one time.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('a')->zeroOrOne();
 
// /a?/
```

### `zeroOrMore`

The `zeroOrMore` method matches the previous token between zero and an unlimited number of times.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('a')->zeroOrMore();
 
// /a*/
```

### `oneOrMore`

The `oneOrMore` method matches the previous token once or an unlimited number of times.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('a')->oneOrMore();
 
// /a+/
```

### `times`

The `times` method matches the previous token a specified number of times.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('a')->times(1);
 
// /a{1}/
```

### `min`

The `min` method matches the previous token between a specified number to an unlimited number of times.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('a')->min(1);
 
// /a{1,}/
```

### `between`

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
