---
title:  Inne
layout: pl-page
next: Gotowe wzorce
next-link: podstawy/wzorce
previous: Kwantyfikatory
previous-link: podstawy/kwantyfikatory
---

## Inne

Każda metoda opisana w tej sekcji pozwala na unikalną manipulację wzorcem.

### `capture`

Metoda `capture` dopasowuje wzorzec wewnątrz grupy i zapamiętuje to dopasowanie.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->capture(
    fn (FluentBuilder $fluent) => $fluent->exactly('.')->letter()
);
 
// /(\.[a-zA-Z])/
```

Używając argumentów `lookbehind` lub `lookahead` można kontrolować, czy pod wzorzec ma być dopasowywany bez zużywania znaków.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->capture(
    callback: fn (FluentBuilder $fluent) => $fluent->exactly('.')->letter(),
    lookbehind: true,
);
 
// /(?<=\.[a-zA-Z])/
```

### `maybe`

Metoda `maybe` dopasowuje wzorzec w grupie zero lub jeden raz.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->maybe(
    fn (FluentBuilder $fluent) => $fluent->exactly('.')->letter()
);
 
// /(\.[a-zA-Z])?/
```

Alternatywnie można go użyć do wyszukiwania pojedynczych znaków

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->maybe(0);
 
// /(0?)/
```

### `oneOf`

Metoda `oneOf` alternatywnie dopasowuje dowolny z podanych znaków.

```php
use Rudashi\Regex;

$pattern = Regex::build()->oneOf('a', 'b', '.');

// /a|b|\./
```

### `or`

Metoda `or` alternatywnie dopasowuje wzorzec przed i po użyciu metody.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('a')->or()->exactly('b');
 
// /a|b/
```

Alternatywnie można użyć właściwości `or`, która działa identycznie.

```php
use Rudashi\Regex;

$pattern = Regex::build()->exactly('a')->or->exactly('b');

// /a|b/
```