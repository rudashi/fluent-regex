---
title: Returning results
layout: pl-page
next: Negation
next-link: advance/negation
previous: Suffix Anchors
previous-link: advance/suffix-anchors
---

# Returning results

### `check`

The `check` method checks whether the pattern matches the context.

```php
use Rudashi\Regex;
 
$pattern = Regex::for('hannah')->exactly('a')->check();
 
// true
```

### `get`

The `get` method returns the entire pattern as a string.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->get();
 
// //
```

### `match`

The `match` method returns all pattern matches in the context.

```php
use Rudashi\Regex;
 
$pattern = Regex::for('hannah')->exactly('a')->match();
 
// ['a', 'a']
```
