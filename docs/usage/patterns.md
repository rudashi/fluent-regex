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

### `Email`

To verify whether an e-mail address is included in a given text, you can use the predefined `EmailPattern` pattern. It will allow you not only to check whether the e-mail is correct but also to isolate it.

```php
use Rudashi\Regex;
 
$pattern = Regex::build([\Rudashi\Patterns\EmailPattern::class])
    ->start()
    ->email()
    ->end();
 
// /^\w+(?:\.\w+)*@(?:[\w-]+\.)+[\w-]{2,}$/
```
