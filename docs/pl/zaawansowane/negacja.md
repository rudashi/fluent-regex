---
title: Negacja
layout: pl-page
next:
next-link:
previous: Wyniki
previous-link: zaawansowane/wyniki
---

## Negacja

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
