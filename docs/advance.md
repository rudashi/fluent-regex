---
title:  Advance
layout: default
---

# Advance

## Modifier flags

#### `ignoreCase`

The `ignoreCase` method adds flags _PCRE_CASELESS_ to the pattern.  
If this flag is set, the letters in the pattern match both uppercase and lower case letters.

```php
use Rudashi\Regex;
 
$regex = Regex::build()->ignoreCase();
 
// /i
```

#### `multiline`

The `multiline` method adds flags _PCRE_MULTILINE_ to the pattern.  
When this flag is set, the `start` and `end` anchors match immediately following or before any newline in the context string.

```php
use Rudashi\Regex;
 
$regex = Regex::build()->multiline();
 
// /m
```

#### `matchNewLine`

The `matchNewLine` method adds flags _PCRE_DOTALL_ to the pattern.  
If this flag is set, `.` in the pattern matches additionally with newlines.

```php
use Rudashi\Regex;
 
$regex = Regex::build()->matchNewLine();
 
// /s
```

#### `ignoreWhitespace`

The `ignoreWhitespace` method adds flags _PCRE_EXTENDED_ to the pattern.  
If this flag is set, whitespace in the pattern is completely ignored, except when escaped or with characters between an unescaped `#`.

```php
use Rudashi\Regex;
 
$regex = Regex::build()->ignoreWhitespace();
 
// x
```

#### `utf8`

The `utf8` method adds flags _PCRE_UTF8_ to the pattern.  
If this flag is set, the pattern and context string are treated as UTF-8.

```php
use Rudashi\Regex;
 
$regex = Regex::build()->utf8();
 
// /u
```

## Prefix anchors

#### `start`

The `start` method adds start anchor. Matches the position before the first character in a context. 
It ensures that the specified pattern occurs right at the start of a line.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->start();
 
// /^/
```

#### `startOfLine`

The `startOfLine` method is equivalent to the `start` method.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->startOfLine();
 
// /^/
```

## Suffix anchors

#### `end`

The `end` method adds an end anchor. Matches the position immediately after the last character in the context.
Ensures that the specified pattern occurs just before the end of the line.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->end();
 
// /$/
```

#### `endOfLine`

The `endOfLine` method is equivalent to the `end` method.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->endOfLine();
 
// /$/
```

## Returning results

#### `get`

The `get` method returns the entire pattern as a string.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->get();
 
// //
```
