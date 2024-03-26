# Fluent Regex

![GitHub last commit](https://img.shields.io/github/last-commit/rudashi/fluent-regex)
![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/rudashi/fluent-regex/tests.yml)
![GitHub repo size](https://img.shields.io/github/repo-size/rudashi/fluent-regex)
![Twitter Follow](https://img.shields.io/twitter/follow/BorysZmuda?style=social)

------

This package provides a simple way to create regular expression in a fluent way.

If you thought that finding a `needle` in a `haystack` was impossible, this repository is for you.

## Requirements

- PHP 8.1+

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

## Documentation

The [FluentRegex documentation](https://rudashi.github.io/fluent-regex/) is extensive and complete, making getting started with regular expression syntax a breeze.

## Changelog

Detailed changes for each release are documented in the [CHANGELOG.md](https://github.com/rudashi/fluent-regex/blob/master/CHANGELOG.md).