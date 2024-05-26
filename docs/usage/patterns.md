---
title:  Patterns
layout: page
next: Advanced
next-link: advance
previous: Others
previous-link: usage/others
---

# Patterns

**`Fluent Regex`** contains a set of predefined patterns for standard validation tasks. These patterns are designed to be simple and easy to use, just use them.  
Ready-to-use patterns can be invoked by calling the appropriate method in the FluentBuilder class.

> **Remember:** Before using ready-made patterns, they must be registered.

## Register patterns

Each pattern must be registered before use. There are several ways to do this.

Use `Regex::build()`:

```php
\Rudashi\Regex::build([
    PredefinedPattern::class,
]);
```

Create new `FluentBuilder` instance:

```php
new \Rudashi\FluentBuilder([
    PredefinedPattern::class,
]);
```

## `Email`

To verify whether an e-mail address is included in a given text, you can use the predefined `EmailPattern` pattern. It will allow you not only to check whether the e-mail is correct but also to isolate it.

```php
use Rudashi\Regex;
 
$pattern = Regex::build([\Rudashi\Patterns\EmailPattern::class])
    ->start()
    ->email()
    ->end();
 
// /^\w+(?:[\.\-]\w+)*@([\w-]+\.)+[\w-]{2,}$/
```

## `Url`

To check whether a given text contains a website, you can use the predefined `UrlPattern` pattern. It only accepts addresses with the **http** or https **protocol** entered.

```php
use Rudashi\Regex;
 
$pattern = Regex::build([\Rudashi\Patterns\UrlPattern::class])
    ->start()
    ->url()
    ->end();
 
// /^https?\:\/\/[^-][a-z\d.-]+[^-]\.[a-z]{2,}(\/[a-z\d\/-]*)?$/
```

## `Credit card`

To find if there is any credit card number in a given text, you can use the predefined `CreditCardPattern` pattern. The pattern identifies **Visa** and **MasterCard** cards.

```php
use Rudashi\Regex;
 
$pattern = Regex::build([\Rudashi\Patterns\CreditCardPattern::class])
    ->start()
    ->creditCard()
    ->end();
 
// /^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14})$/
```
