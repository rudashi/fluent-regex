---
title:  Wstęp
layout: page
next: Instalacja
next-link: instalacja
previous: 
previous-link: 
---

# Wstęp

**`Fluent Regex`** to narzędzie, które w prosty sposób pozwala tworzyć wyrażenia regularne.  
Umożliwia intuicyjne tworzenie wzorców, które wyszukają odpowiedni fragment w tekście.

Poniżej przykład:

```php
Regex::build()
  ->startOfLine()
  ->group(fn (Fluent $fluent) => $fluent->find('http')->or('https'))
  ->then('://')
  ->ignoreCase()

// ^(http|https)\:\/\//i
```

Poza wyszukiwaniem, zweryfikuje również, czy w danym tekście znajduje się to, czego szukamy.


```php
Regex::for('https://100commitow.pl/')->find('100commitow')->check();

// True
```

## 🏅 Odznaki

![GitHub last commit](https://img.shields.io/github/last-commit/rudashi/fluent-regex)  
![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/rudashi/fluent-regex/tests.yml?label=tests)  
![GitHub repo size](https://img.shields.io/github/repo-size/rudashi/fluent-regex)  
![Packagist Version](https://img.shields.io/packagist/v/rudashi/fluent-regex)  
