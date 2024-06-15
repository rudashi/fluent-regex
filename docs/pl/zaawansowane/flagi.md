---
title: Flagi
layout: pl-page
next: Kotwica początku
next-link: zaawansowane/kotwica-start
previous: Zaawansowane
previous-link: zaawansowane
---

## Flagi

### `ignoreCase`

Metoda `ignoreCase` dodaje flagę _PCRE_CASELESS_ do wzorca.  
Jeśli ta flaga jest ustawiona, litery we wzorcu pasują zarówno do wielkich, jak i małych liter.

```php
use Rudashi\Regex;

$regex = Regex::build()->ignoreCase();

// /i
```

### `multiline`

Metoda `multiline` dodaje flagę _PCRE_MULTILINE_ do wzorca.  
Gdy ta flaga jest ustawiona, kotwice `start` i `end` pasują bezpośrednio po lub przed każdą nową linią w łańcuchu kontekstowym.

```php
use Rudashi\Regex;
 
$regex = Regex::build()->multiline();
 
// /m
```

### `matchNewLine`

Metoda `matchNewLine` dodaje flagę _PCRE_DOTALL_ do wzorca.  
Jeśli ta flaga jest ustawiona, `.` we wzorcu dopasowuje się dodatkowo z nowymi liniami.

```php
use Rudashi\Regex;

$regex = Regex::build()->matchNewLine();

// /s
```

### `ignoreWhitespace`

Metoda `ignoreWhitespace` dodaje flagę _PCRE_EXTENDED_ do wzorca.  
Jeśli ta flaga jest ustawiona, białe znaki we wzorcu są całkowicie ignorowane, z wyjątkiem znaków escaped lub znaków pomiędzy nieescaped `#`.

```php
use Rudashi\Regex;
 
$regex = Regex::build()->ignoreWhitespace();
 
// x
```

### `utf8`

Metoda `utf8` dodaje flagę _PCRE_UTF8_ do wzorca.  
Jeśli ta flaga jest ustawiona, wzorzec i ciąg kontekstu są traktowane jako UTF-8.

```php
use Rudashi\Regex;

$regex = Regex::build()->utf8();

// /u
```

### `unicode`

Metoda `unicode` jest aliasem dla metody `utf8`.

```php
use Rudashi\Regex;
 
$regex = Regex::build()->unicode();
 
// /u
```
