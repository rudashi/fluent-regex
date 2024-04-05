---
title:  Negation
layout: default
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

---

Continue to next section, for more information on how to use [Suffix Anchors →](suffix-anchors).