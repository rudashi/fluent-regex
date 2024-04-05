---
title:  Modifier flags
layout: default
---

# Modifier flags

### `ignoreCase`

The `ignoreCase` method adds flags _PCRE_CASELESS_ to the pattern.  
If this flag is set, the letters in the pattern match both uppercase and lower case letters.

```php
use Rudashi\Regex;
 
$regex = Regex::build()->ignoreCase();
 
// /i
```

### `multiline`

The `multiline` method adds flags _PCRE_MULTILINE_ to the pattern.  
When this flag is set, the `start` and `end` anchors match immediately following or before any newline in the context string.

```php
use Rudashi\Regex;
 
$regex = Regex::build()->multiline();
 
// /m
```

### `matchNewLine`

The `matchNewLine` method adds flags _PCRE_DOTALL_ to the pattern.  
If this flag is set, `.` in the pattern matches additionally with newlines.

```php
use Rudashi\Regex;
 
$regex = Regex::build()->matchNewLine();
 
// /s
```

### `ignoreWhitespace`

The `ignoreWhitespace` method adds flags _PCRE_EXTENDED_ to the pattern.  
If this flag is set, whitespace in the pattern is completely ignored, except when escaped or with characters between an unescaped `#`.

```php
use Rudashi\Regex;
 
$regex = Regex::build()->ignoreWhitespace();
 
// x
```

### `utf8`

The `utf8` method adds flags _PCRE_UTF8_ to the pattern.  
If this flag is set, the pattern and context string are treated as UTF-8.

```php
use Rudashi\Regex;
 
$regex = Regex::build()->utf8();
 
// /u
```

---

Continue to next section, for more information on how to use [Prefix Anchors →](prefix-anchors).