---
title:  Negation
layout: page
next: 
next-link: 
previous: Returning results
previous-link: advance/returning-results
---

# Negation

### `not`

The `not` method negates the next expression.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->not()->word();
 
// /[^\w]/
```

Alternatively, you can use the `not` property, which works identically.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->not->word();
 
// /[^\w]/
```
