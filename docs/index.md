---
title:  Introduction
layout: default
---

# Introduction

This package provides a simple way to create Regex in a fluent way. 

Here is a quick example:

```php
Regex::build()
  ->startOfLine()
  ->group(fn (Fluent $fluent) => $fluent->find('http')->or('https'))
  ->then('://')
  ->ignoreCase()

// ^(http|https)\:\/\//i
```

You can also check if your string is valid to pattern:

```php
Regex::for('https://100commitow.pl/')->find('100commitow')->check();

// True
```

## 🏅 There are badges 

![GitHub last commit](https://img.shields.io/github/last-commit/rudashi/fluent-regex)  
![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/rudashi/fluent-regex/tests.yml?label=tests)  
![GitHub repo size](https://img.shields.io/github/repo-size/rudashi/fluent-regex)  
![Packagist Version](https://img.shields.io/packagist/v/rudashi/fluent-regex)  

---

Now you are ready to perform the [Installation →](installation).