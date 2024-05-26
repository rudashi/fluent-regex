---
title:  Suffix anchors
layout: page
next: Returning results
next-link: advance/returning-results
previous: Prefix anchors
previous-link: advance/prefix-anchors
---

# Suffix anchors

## `end`

The `end` method adds an end anchor. Matches the position immediately after the last character in the context.
Ensures that the specified pattern occurs just before the end of the line.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->end();
 
// /$/
```

## `endOfLine`

The `endOfLine` method is equivalent to the `end` method.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->endOfLine();
 
// /$/
```
