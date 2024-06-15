---
title: Kotwica końca
layout: pl-page
next: Wyniki
next-link: zaawansowane/wyniki
previous: Kotwica początku
previous-link: zaawansowane/kotwica-start
---

## Kotwica końca

### `end`

Metoda `end` dodaje kotwicę końcową. Dopasowuje pozycję bezpośrednio po ostatnim znaku w kontekście.
Zapewnia, że określony wzorzec występuje tuż przed końcem linii.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->end();
 
// /$/
```

### `endOfLine`

Metoda `endOfLine` jest aliasem dla metody `end`.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->endOfLine();
 
// /$/
```
