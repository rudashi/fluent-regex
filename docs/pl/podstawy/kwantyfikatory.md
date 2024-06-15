---
title: Kwantyfikatory
layout: pl-page
next: Inne
next-link: podstawy/inne
previous: Dodatkowe metody
previous-link: podstawy/dodatkowe-metody
---

## Kwantyfikatory

Kwantyfikatory określają, ile wystąpień znaku, grupy lub znaku musi być obecnych w podanym tekście, aby znaleźć dopasowanie.

### `zeroOrOne`

Metoda `zeroOrOne` dopasowuje poprzedni token zero lub jeden raz.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('a')->zeroOrOne();
 
// /a?/
```

### `zeroOrMore`

Metoda `zeroOrMore` dopasowuje poprzedni token od zera do nieograniczonej liczby razy.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('a')->zeroOrMore();
 
// /a*/
```

### `oneOrMore`

Metoda `oneOrMore` dopasowuje poprzedni token raz lub nieograniczoną liczbę razy.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('a')->oneOrMore();
 
// /a+/
```

### `times`

Metoda `times` dopasowuje poprzedni token określoną liczbę razy.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('a')->times(1);
 
// /a{1}/
```

### `min`

Metoda `min` dopasowuje poprzedni token od określonej liczby do nieograniczonej liczby razy.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('a')->min(1);
 
// /a{1,}/
```

### `between`

Metoda `between` dopasowuje poprzedni token w podanym zakresie.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('a')->between(1, 3);
 
// /a{1,3}/
```

Dodatkowo, jeśli pominiesz drugi argument, metoda zachowuje się identycznie jak `min`.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('a')->between(1);
 
// /a{1,}/
```
