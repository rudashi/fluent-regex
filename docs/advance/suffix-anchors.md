---
title:  Suffix anchors
layout: default
---

# Suffix anchors

### `end`

The `end` method adds an end anchor. Matches the position immediately after the last character in the context.
Ensures that the specified pattern occurs just before the end of the line.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->end();
 
// /$/
```

### `endOfLine`

The `endOfLine` method is equivalent to the `end` method.

```php
use Rudashi\Regex;
 
$pattern = Regex::build()->endOfLine();
 
// /$/
```

---

Continue to next section, for more information on how to use [Returning results →](returning-results).