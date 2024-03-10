# Fluent Regex

![GitHub last commit](https://img.shields.io/github/last-commit/rudashi/fluent-regex)
![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/rudashi/fluent-regex/tests.yml)
![GitHub repo size](https://img.shields.io/github/repo-size/rudashi/fluent-regex)
![Twitter Follow](https://img.shields.io/twitter/follow/BorysZmuda?style=social)

Jeżeli wydawało Ci się, że odnalezienie igły w stogu siana jest niemożliwe, to znaczy, że te repozytorium jest dla Ciebie.

## Requirements
- PHP ^8.1
- Composer

## Installation
Install the package via Composer

```shell
composer require rudashi/fluent-regex --dev --with-all-dependencies
```

## Usage

```php
$regex = Regex::build()
  ->startOfLine()
  ->group(fn (Fluent $fluent) => $fluent->find('http')->or('https'))
  ->then('://')
  ->ignoreCase();

$regex->dump();
// ^(http|https)\:\/\//i

$match = Regex::for('https://100commitow.pl/')->find('100commitow')->check();
// True
```

## Available Methods

| Name        | Description                                       | Regex |
|-------------|---------------------------------------------------|:-----:|
| startOfLine | asserts position at start of a line               |   ^   |
| group       | capturing Group                                   |  ()   |
| find        | add a string to find                              |       |
| or          | alternative value to find                         |  \|   |
| then        | add a string to find                              |       |
| check       | returns true or false when find match             |       |
| ignoreCase  | case insensitive match (ignores case of [a-zA-Z]) |  / i  |
