---
title: Flagi
layout: pl-page
next: Kotwica początku
next-link: zaawansowane/kotwica-start
previous: Zaawansowane
previous-link: zaawansowane
---

# Flagi

## `ignoreCase`

The `ignoreCase` method adds flags _PCRE_CASELESS_ to the pattern.  
If this flag is set, the letters in the pattern match both uppercase and lower case letters.

```php
use Rudashi\Regex;
 
$regex = Regex::build()->ignoreCase();
 
// /i
```

## `multiline`

The `multiline` method adds flags _PCRE_MULTILINE_ to the pattern.  
When this flag is set, the `start` and `end` anchors match immediately following or before any newline in the context string.

```php
use Rudashi\Regex;
 
$regex = Regex::build()->multiline();
 
// /m
```

## `matchNewLine`

The `matchNewLine` method adds flags _PCRE_DOTALL_ to the pattern.  
If this flag is set, `.` in the pattern matches additionally with newlines.

```php
use Rudashi\Regex;
 
$regex = Regex::build()->matchNewLine();
 
// /s
```

## `ignoreWhitespace`

The `ignoreWhitespace` method adds flags _PCRE_EXTENDED_ to the pattern.  
If this flag is set, whitespace in the pattern is completely ignored, except when escaped or with characters between an unescaped `#`.

```php
use Rudashi\Regex;
 
$regex = Regex::build()->ignoreWhitespace();
 
// x
```

## `utf8`

The `utf8` method adds flags _PCRE_UTF8_ to the pattern.  
If this flag is set, the pattern and context string are treated as UTF-8.

```php
use Rudashi\Regex;
 
$regex = Regex::build()->utf8();
 
// /u
```

## `unicode`

The `unicode` method is an alias for the `utf8` method.

```php
use Rudashi\Regex;
 
$regex = Regex::build()->unicode();
 
// /u
```
