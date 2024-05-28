---
title:  Prefix anchors
layout: page
next: Suffix Anchors
next-link: advance/suffix-anchors
previous: Modifier flags
previous-link: advance/modifier-flags
---

## Prefix anchors

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
