---
title:  Helpers
layout: page
next: Tokens
next-link: usage/tokens
previous: Usage
previous-link: usage
---

# Helpers

You can start creating your regex by using `Regex::build()`.  
The `build()` method is used every time you want to create a pattern.

### `build`

The `build` method creates a new `Rudashi\FluentBuilder` instance.

```php
use Rudashi\Regex;
 
$builder = Regex::build();
 
// Rudashi\FluentBuilder
```

You may also pass an array of predefined patterns to use in a given context string:

```php
use Rudashi\Regex;
 
$builder = Regex::build([
    \Rudashi\Patterns\EmailPattern::class,
]);
```

### `for`

The `for` method adds context to `Rudashi\FluentBuilder` instance.

```php
use Rudashi\Regex;
 
$builder = Regex::for('Hello, world!');
 
// Rudashi\FluentBuilder
```

### `start`

The `start` method adds start flag.

```php
use Rudashi\Regex;
 
$pattern = Regex::start();
 
// /^/
```

### `startOfLine`

The `startOfLine` method is equivalent to the `Regex::start` method.

```php
use Rudashi\Regex;
 
$pattern = Regex::startOfLine();
 
// /^/
```
