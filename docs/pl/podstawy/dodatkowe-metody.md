---
title: Dodatkowe metody
layout: pl-page
next: Kwantyfikatory
next-link: podstawy/kwantyfikatory
previous: Pomocnicze metody
previous-link: podstawy/pomocnicze-metody
---

## Dodatkowe metody

Przed użyciem tokenów należy zainicjować `FluentBuilder`. W tym celu należy użyć jednej z [metod pomocnicznych](pomocnicze-metody.md).  Tokeny mogą być łączone w łańcuchy, tworząc coraz bardziej złożone wyrażenia regularne.

### `anything`

Metoda `anything` dopasowuje dowolne znaki.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->anything();
 
// /.*/
```

### `character`

Metoda `character` dosłownie dopasowuje podany znak.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->character('-');
 
// /-/
```

### `and`

Metoda `and` jest aliasem dla metody `character`.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->and('-');
 
// /-/
```

### `raw`

Metoda `raw` jest aliasem dla metody `character`.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->raw('-');
 
// /-/
```

### `exactly`

Metoda `exactly` dosłownie dopasowuje podany ciąg znaków.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('foo');
 
// /foo/
```

Znaki specjalne są dodatkowo unikane.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->exactly('._%+-[]');
 
// /\._%\+\-\[\]/
```

### `find`

Metoda `find` jest aliasem dla metody `exactly`.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->find('foo');
 
// /foo/
```

### `then`

Metoda `then` jest aliasem dla metody `exactly`.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->then('foo');
 
// /foo/
```

### `letter`

Metoda `letter` dopasowuje każdą pojedynczą literę, niezależnie od tego czy jest ona mała czy wielka.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->letter();
 
// /[a-zA-Z]/
```

### `lowerLetter`

Metoda `lowerLetter` dopasowuje każdą pojedynczą małą literę.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->lowerLetter();
 
// /[a-z]/
```

### `number`

Metoda `number` dopasowuje dowolną pojedynczą liczbę (odpowiednik `\d`).

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->number();
 
// /[0-9]/
```

### `numbers`

Metoda `numbers` dopasowuje wszystkie liczby.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->numbers();
 
// /[0-9]+/
```

### `whitespace`

Metoda `whitespace` dopasowuje dowolny biały znak (odpowiednik [\r\n\t\f\v ]).

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->whitespace();
 
// /\s/
```

### `nonWhitespace`

Metoda `nonWhitespace` dopasowuje każdy znak niebędący białym znakiem.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->nonWhitespace();
 
// /\S/
```

### `digit`

Metoda `digit` dopasowuje dowolną pojedynczą cyfrę (odpowiednik [0-9]).

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->digit();
 
// /\d/
```

### `digits`

Metoda `digits` dopasowuje wszystkie cyfry.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->digits();
 
// /\d+/
```

### `nonDigit`

Metoda `nonDigit` dopasowuje każdy pojedynczy znak, który nie jest cyfrą (odpowiednik [^0-9]).

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->nonDigit();
 
// /\D/
```

### `nonDigits`

Metoda `nonDigits` dopasowuje wszystkie znaki nie będące cyfra.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->nonDigits();
 
// /\D+/
```

### `word`

Metoda `word` dopasowuje dowolny znak słowa (odpowiednik [a-zA-Z0-9_]).

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->word();
 
// /\w/
```

### `words`

Metoda `words` dopasowuje wszystkie znaki słów.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->words();
 
// /\w+/
```

### `boundary`

Metoda `boundary` pozwala na dopasowanie tylko całych słów bez zużywania żadnego znaku (odpowiednik (^\w|\w$|\W\w|\w\W)).

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->boundary();
 
// /\b/
```

### `nonBoundary`

Metoda `nonBoundary` pasuje do każdej pozycji, gdzie `boundary` nie pasuje.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->nonBoundary();
 
// /\B/
```

### `anyOf`

Metoda `anyOf` dopasowuje dowolne pojedyncze znaki obecne w podanym ciągu znaków.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->anyOf('abc');
 
// /[abc]/
```

### `tab`

Metoda `tab` dopasowuje znak tabulatora.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->tab();
 
// /\t/
```

### `carriageReturn`

Metoda `carriageReturn` dopasowuje powrót karetki (carriage).

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->carriageReturn();
 
// /\r/
```

### `newline`

Metoda `newline` dopasowuje znak końca linii (newline).

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->newline();
 
// /\r/
```

### `linebreak`

Metoda `linebreak` dopasowuje powrót karetki lub nową linię.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->linebreak();
 
// /\r|\n/
```
