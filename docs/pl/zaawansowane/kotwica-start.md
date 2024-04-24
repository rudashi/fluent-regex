---
title: Kotwica początku
layout: pl-page
next: Kotwica końca
next-link: zaawansowane/kotwica-koniec
previous: Flagi
previous-link: zaawansowane/flagi
---

# Kotwica początku

### `start`

The `start` method adds start anchor. Matches the position before the first character in a context.
It ensures that the specified pattern occurs right at the start of a line.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->start();
 
// /^/
```

### `startOfLine`

The `startOfLine` method is equivalent to the `start` method.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->startOfLine();
 
// /^/
```
