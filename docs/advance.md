---
title: Advance
layout: page
next: Modifier flags
next-link: advance/modifier-flags
previous: Patterns
previous-link: usage/patterns
---

## Advance
Apart from basic tokens, the regular expression can be extended with appropriate modifiers or anchors. 
Additionally, some methods can be called by a property representative.

### Modifier flags

- [`ignoreCase`](advance/modifier-flags#ignorecase)
- [`multiline`](advance/modifier-flags#multiline)
- [`matchNewLine`](advance/modifier-flags#matchnewline)
- [`ignoreWhitespace`](advance/modifier-flags#ignorewhitespace)
- [`utf8`](advance/modifier-flags#utf8)
- [`unicode`](advance/modifier-flags#unicode)

### Prefix anchors

- [`start`](advance/prefix-anchors#start)
- [`startOfLine`](advance/prefix-anchors#startofline)

### Suffix anchors

- [`end`](advance/suffix-anchors#end)
- [`endOfLine`](advance/suffix-anchors#endofline)

### Returning results

- [`check`](advance/returning-results#check)
- [`get`](advance/returning-results#get)
- [`match`](advance/returning-results#match)

### Negation

- [`not`](advance/negation#not)

### Properties

#### Tokens
- letter
- lowerLetter
- number
- numbers
- whitespace
- nonWhitespace
- digit
- digits
- nonDigit
- nonDigits
- word
- words
- tab
- carriageReturn
- newline
- linebreak
- boundary
- nonBoundary
- or
- anything
- not

#### Quantifiers

- zeroOrOne
- zeroOrMore
- oneOrMore

#### Anchors

- start
- startOfLine
- end
- endOfLine

#### Flags

- ignoreCase
- multiline
- matchNewLine
- ignoreWhitespace
- utf8
- unicode