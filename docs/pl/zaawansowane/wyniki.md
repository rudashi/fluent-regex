---
title: Wyniki
layout: pl-page
next: Negacja
next-link: zaawansowane/negacja
previous: Kotwica końca
previous-link: zaawansowane/kotwica-koniec
---

# Wyniki

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
