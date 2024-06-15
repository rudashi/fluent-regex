---
title: Wyniki
layout: pl-page
next: Negacja
next-link: zaawansowane/negacja
previous: Kotwica końca
previous-link: zaawansowane/kotwica-koniec
---

## Wyniki

### `check`

Metoda `check` sprawdza, czy wzorzec pasuje do kontekstu.

```php
use Rudashi\Regex;
 
$pattern = Regex::for('hannah')->exactly('a')->check();
 
// true
```

### `get`

Metoda `get` zwraca cały wzorzec jako ciąg znaków.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->get();
 
// //
```

### `match`

Metoda `match` zwraca wszystkie dopasowania wzorca w kontekście.

```php
use Rudashi\Regex;
 
$pattern = Regex::for('hannah')->exactly('a')->match();
 
// ['a', 'a']
```
