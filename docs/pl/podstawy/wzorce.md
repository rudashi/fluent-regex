---
title:  Gotowe wzorce
layout: pl-page
next: Zaawansowane
next-link: zaawansowane
previous: Inne
previous-link: podstawy/inne
---

## Gotowe wzorce

**`Fluent Regex`** zawiera zestaw predefiniowanych wzorców dla standardowych typów walidacji. 
Wzorce te zostały zaprojektowane tak, aby były proste i łatwe w użyciu.  
Gotowe do użycia wzorce można wywołać poprzez wywołanie odpowiedniej metody w klasie `FluentBuilder`.

> **Pamiętaj:** Przed użyciem gotowych wzorców należy je zarejestrować.

### Rejestracja wzorca

Każdy wzorzec musi zostać zarejestrowany przed użyciem. Można to zrobić na kilka sposobów.

Poprzez `Regex::build()`:

```php
Rudashi\Regex::build([
    PredefinedPattern::class,
]);
```

Lub utwórz nową instancję `FluentBuilder`:

```php
new Rudashi\FluentBuilder([
    PredefinedPattern::class,
]);
```

### `Date`

Jeśli chcesz znaleźć datę w tekście, możesz użyć predefiniowanego wzorca `DatePattern`. Wzorzec identyfikuje daty 
w formatach `mm-dd-rrrr`, `dd-mm-rrrr`, `rrrr-mm-dd`, niezależnie od tego, czy użyto ukośnika `/`, kropki `.`, czy myślnika `-`.

```php
use Rudashi\Regex;
 
$pattern = Regex::build([Rudashi\Patterns\DatePattern::class])
    ->start()
    ->date()
    ->end();
 ```

### `Time`

Gdy trzeba sprawdzić, czy dany tekst zawiera odwołanie do czasu, można użyć predefiniowanego wzorca `TimePattern`. 
Wzorzec ten identyfikuje czas 12 i 24-godzinny.

```php
use Rudashi\Regex;
 
$pattern = Regex::build([Rudashi\Patterns\TimePattern::class])
    ->start()
    ->time()
    ->end();
 
// /^(?<!\d)(?:(?:[01]?\d|2[0-3]):(?:[0-5]\d)(?::(?:[0-5]\d))?(?! ?[AaPp][Mm])|(?:0?[1-9]|1[0-2]):(?:[0-5]\d)(?: ?[AaPp][Mm])?)$/
```

### `IPv4 address`

Aby zidentyfikować, czy dany tekst zawiera adresy IP w wersji 4, można użyć predefiniowanego wzorca `IPAddressPattern`.
Wzorzec ten identyfikuje tylko adresy zgodne z **IPv4**.

```php
use Rudashi\Regex;
 
$pattern = Regex::build([Rudashi\Patterns\IPAddressPattern::class])
    ->start()
    ->ipAddress()
    ->end();
 
// /^((25[0-5]|(2[0-4]|1\d|[1-9]|)\d)\.?\b){4}$/
```

### `IPv6 address`

Możesz użyć predefiniowanego wzorca `IPv6AddressPattern`, aby sprawdzić, czy dany tekst zawiera adresy IP.
Ten wzorzec może znaleźć tylko adresy pasujące do **IPv6**.

```php
use Rudashi\Regex;
 
$pattern = Regex::build([Rudashi\Patterns\IPv6AddressPattern::class])
    ->start()
    ->ipv6()
    ->end();
 
// /^(([0-9a-fA-F]{1,4}:){7,7}[0-9a-fA-F]{1,4}|...|:((:[0-9a-fA-F]{1,4}){1,7}|:))$/
```

### `MAC address`

Aby sprawdzić, czy dany tekst zawiera MAC adresy, można użyć predefiniowanego wzorca `MACAddressPattern`.
Wzorzec może rozróżniać adresy, które używają nie tylko domyślnego dwukropka `:`, ale także kropki `.` i myślnika `-`.

```php
use Rudashi\Regex;
 
$pattern = Regex::build([Rudashi\Patterns\MACAddressPattern::class])
    ->start()
    ->macAddress()
    ->end();
 
// /^(?<![0-9A-Fa-f.:-])(?:[0-9A-Fa-f]{2}[:.-]){5}(?:[0-9A-Fa-f]{2})(?![0-9A-Fa-f:-])$/
```

### `Email`

Aby zweryfikować, czy adres e-mail jest zawarty w danym tekście, można użyć predefiniowanego wzorca `EmailPattern`. 
Umożliwi on nie tylko sprawdzenie poprawności adresu e-mail, ale także jego wyizolowanie.

```php
use Rudashi\Regex;
 
$pattern = Regex::build([Rudashi\Patterns\EmailPattern::class])
    ->start()
    ->email()
    ->end();
 
// /^\w+(?:[\.\-]\w+)*@([\w-]+\.)+[\w-]{2,}$/
```

### `Url`

Aby sprawdzić, czy dany tekst zawiera stronę internetową, można użyć predefiniowanego wzorca `UrlPattern`. 
Akceptuje on tylko adresy z **protokołem http** lub https**.

```php
use Rudashi\Regex;
 
$pattern = Regex::build([Rudashi\Patterns\UrlPattern::class])
    ->start()
    ->url()
    ->end();
 
// /^https?\:\/\/[^-][a-z\d.-]+[^-]\.[a-z]{2,}(\/[a-z\d\/-]*)?$/
```

### `Credit card`

Aby sprawdzić, czy w danym tekście znajduje się numer karty kredytowej, można użyć predefiniowanego wzorca `CreditCardPattern`. 
Wzorzec ten identyfikuje karty **Visa** i **MasterCard**.

```php
use Rudashi\Regex;
 
$pattern = Regex::build([Rudashi\Patterns\CreditCardPattern::class])
    ->start()
    ->creditCard()
    ->end();
 
// /^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14})$/
```
