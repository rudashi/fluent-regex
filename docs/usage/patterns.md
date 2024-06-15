---
title:  Patterns
layout: page
next: Advanced
next-link: advance
previous: Others
previous-link: usage/others
---

## Patterns

**`Fluent Regex`** contains a set of predefined patterns for standard validation tasks. 
These patterns are designed to be simple and easy to use, just use them.  
Ready-to-use patterns can be invoked by calling the appropriate method in the `FluentBuilder` class.

> **Remember:** Before using ready-made patterns, they must be registered.

### Register patterns

Each pattern must be registered before use. There are several ways to do this.

Use `Regex::build()`:

```php
Rudashi\Regex::build([
    PredefinedPattern::class,
]);
```

Create new `FluentBuilder` instance:

```php
new Rudashi\FluentBuilder([
    PredefinedPattern::class,
]);
```

### `Date`

If you need to find a date in text, you can use the predefined `DatePattern` pattern. The pattern identifies dates in the 
formats `mm-dd-yyyy`, `dd-mm-yyyy`, `yyyy-mm-dd`, regardless of whether a backslash `/`, dot `.`, or dash `-` is used.

```php
use Rudashi\Regex;
 
$pattern = Regex::build([Rudashi\Patterns\DatePattern::class])
    ->start()
    ->date()
    ->end();
 ```

### `Time`

When you need to check whether a given text contains timestamps, you can use the predefined `TimePattern` pattern. 
This pattern identifies 12-hour and 24-hour time.

```php
use Rudashi\Regex;
 
$pattern = Regex::build([Rudashi\Patterns\TimePattern::class])
    ->start()
    ->time()
    ->end();
 
// /^(?<!\d)(?:(?:[01]?\d|2[0-3]):(?:[0-5]\d)(?::(?:[0-5]\d))?(?! ?[AaPp][Mm])|(?:0?[1-9]|1[0-2]):(?:[0-5]\d)(?: ?[AaPp][Mm])?)$/
```

### `IPv4 address`

To identify whether a given text contains IP version 4 addresses, you can use the predefined `IPAddressPattern` pattern. 
The pattern only identifies **IPv4**-compliant addresses.

```php
use Rudashi\Regex;
 
$pattern = Regex::build([Rudashi\Patterns\IPAddressPattern::class])
    ->start()
    ->ipAddress()
    ->end();
 
// /^((25[0-5]|(2[0-4]|1\d|[1-9]|)\d)\.?\b){4}$/
```

### `IPv6 address`

You can use the predefined `IPv6AddressPattern` pattern to find whether a given text contains IP addresses. 
This pattern can only find addresses that match **IPv6**.

```php
use Rudashi\Regex;
 
$pattern = Regex::build([Rudashi\Patterns\IPv6AddressPattern::class])
    ->start()
    ->ipv6()
    ->end();
 
// /^(([0-9a-fA-F]{1,4}:){7,7}[0-9a-fA-F]{1,4}|...|:((:[0-9a-fA-F]{1,4}){1,7}|:))$/
```

### `MAC address`

To find whether a given text contains MAC addresses, you can use the predefined `MACAddressPattern` pattern. 
The pattern can distinguish addresses that use not only the default colon `:`, but also dot `.` and dash `-`.

```php
use Rudashi\Regex;
 
$pattern = Regex::build([Rudashi\Patterns\MACAddressPattern::class])
    ->start()
    ->macAddress()
    ->end();
 
// /^(?<![0-9A-Fa-f.:-])(?:[0-9A-Fa-f]{2}[:.-]){5}(?:[0-9A-Fa-f]{2})(?![0-9A-Fa-f:-])$/
```

### `Email`

To verify whether an e-mail address is included in a given text, you can use the predefined `EmailPattern` pattern. 
It will allow you not only to check whether the e-mail is correct but also to isolate it.

```php
use Rudashi\Regex;
 
$pattern = Regex::build([Rudashi\Patterns\EmailPattern::class])
    ->start()
    ->email()
    ->end();
 
// /^\w+(?:[\.\-]\w+)*@([\w-]+\.)+[\w-]{2,}$/
```

### `Url`

To check whether a given text contains a website, you can use the predefined `UrlPattern` pattern. 
It only accepts addresses with the **http** or https **protocol** entered.

```php
use Rudashi\Regex;
 
$pattern = Regex::build([Rudashi\Patterns\UrlPattern::class])
    ->start()
    ->url()
    ->end();
 
// /^https?\:\/\/[^-][a-z\d.-]+[^-]\.[a-z]{2,}(\/[a-z\d\/-]*)?$/
```

### `Credit card`

To find if there is any credit card number in a given text, you can use the predefined `CreditCardPattern` pattern. 
The pattern identifies **Visa** and **MasterCard** cards.

```php
use Rudashi\Regex;
 
$pattern = Regex::build([Rudashi\Patterns\CreditCardPattern::class])
    ->start()
    ->creditCard()
    ->end();
 
// /^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14})$/
```
