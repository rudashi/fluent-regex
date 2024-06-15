---
title: Kotwica początku
layout: pl-page
next: Kotwica końca
next-link: zaawansowane/kotwica-koniec
previous: Flagi
previous-link: zaawansowane/flagi
---

## Kotwica początku

### `start`

Metoda `start` dodaje kotwicę początkową. Dopasowuje pozycję przed pierwszym znakiem w kontekście.
Zapewnia, że określony wzorzec występuje na samym początku linii.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->start();
 
// /^/
```

### `startOfLine`

Metoda `startOfLine` jest aliasem dla metody `start`.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->startOfLine();
 
// /^/
```
