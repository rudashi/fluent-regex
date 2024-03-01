# Fluent Regex

![GitHub last commit](https://img.shields.io/github/last-commit/rudashi/fluent-regex)
![GitHub repo size](https://img.shields.io/github/repo-size/rudashi/fluent-regex)
![Twitter Follow](https://img.shields.io/twitter/follow/BorysZmuda?style=social)

## Requirements
- PHP ^8.0
- Composer

## Installation
Install the package via Composer

```shell
composer require rudashi/fluent-regex:dev-master
```

## Usage
This simple example illustrates the way you would use `flux` and it's fluent interface to build complex patterns.

```php
$regex = Regex::build()
  ->startOfLine()
  ->group(fn (Fluent $fluent) => $fluent->find('http')->or('https'))
  ->then('://')
  ->ignoreCase();

$regex->dump();
// ^(http|https)?\:\/\//i

$match = Regex::for('https://100commitow.pl/')->find('100commitow')->check();
// True
```

## Available Methods
