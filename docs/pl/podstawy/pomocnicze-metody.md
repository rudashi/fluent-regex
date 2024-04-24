---
title: Pomocnicze metody
layout: pl-page
next: Dodatkowe metody
next-link: podstawy/dodatkowe-metody
previous: Podstawy
previous-link: podstawy
---

# Pomocnicze metody

Budowę wyrażenia regularnego zaczynasz od użycia `Regex::build()`.  
Pozostałe metody pomocnicze wykorzystują `build()` przy tworzeniu wzorca.

### `build`

Metoda `build` rozpoczyna każde tworzenie wyrażenia  `Rudashi\FluentBuilder`.

```php
use Rudashi\Regex;
 
$builder = Regex::build();
 
// Rudashi\FluentBuilder
```

### `for`

Metoda `for` dodaje kontekst dla instancji `Rudashi\FluentBuilder`. Będzie to tekst, na którym chcesz, żeby wyrażenie
regularne zadziałało.

```php
use Rudashi\Regex;
 
$builder = Regex::for('Hello, world!');
 
// Rudashi\FluentBuilder
```

### `start`

Metoda `start` dodaje flagę `start`.

```php
use Rudashi\Regex;
 
$pattern = Regex::start();
 
// /^/
```

### `startOfLine`

Metoda `startOfLine` jest odpowiednikiem dla metody `Regex::start`.

```php
use Rudashi\Regex;
 
$pattern = Regex::startOfLine();
 
// /^/
```
