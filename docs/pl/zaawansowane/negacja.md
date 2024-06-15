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

Metoda `not` neguje następne wyrażenie.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->not()->word();
 
// /[^\w]/
```

Alternatywnie, można użyć właściwości `not`, która zadziała identycznie.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->not->word();
 
// /[^\w]/
```
