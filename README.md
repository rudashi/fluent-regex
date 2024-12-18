# Fluent Regex

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/f54e6ee0b3a64876b466cc46b93fac33)](https://app.codacy.com/gh/rudashi/fluent-regex/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade)
[![codecov](https://codecov.io/gh/rudashi/fluent-regex/graph/badge.svg?token=0D3GQBHV1Y)](https://codecov.io/gh/rudashi/fluent-regex)
![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/rudashi/fluent-regex/tests.yml)
![GitHub last commit](https://img.shields.io/github/last-commit/rudashi/fluent-regex)  
![GitHub repo size](https://img.shields.io/github/repo-size/rudashi/fluent-regex)
[![Total Downloads](https://img.shields.io/packagist/dt/rudashi/fluent-regex)](https://packagist.org/packages/rudashi/fluent-regex)
![GitHub License](https://img.shields.io/github/license/rudashi/fluent-regex)

------

This package provides a simple way to create regular expression in a fluent way.

**Fluent Regex** is a library in PHP that simplifies the creation and management of regular expressions through
the use of fluent syntax. Traditional regular expressions can be difficult to read and understand, especially when
they become complex. **Fluent Regex** solves this problem by allowing you to build regular expressions using
a readable and intuitive object-oriented interface.

> If you thought that finding a `needle` in a `haystack` was impossible, this repository is for you.

## Installation

Install the [package](https://packagist.org/packages/rudashi/fluent-regex) via [Composer](https://getcomposer.org/)

```shell
composer require rudashi/fluent-regex
```

## Version Guidance

| Version | Branch                                                  | PHP Version | Composer Install                             |
|---------|---------------------------------------------------------|-------------|----------------------------------------------|
| v2.x    | [master](https://github.com/rudashi/fluent-regex)       | ^8.2        | `composer require rudashi/fluent-regex`      |
| v1.x    | [1.x](https://github.com/rudashi/fluent-regex/tree/1.x) | ^8.1        | `composer require rudashi/fluent-regex:^1.0` |

## Usage

```php
$regex = Rudashi\Regex::build()
    ->startOfLine()
    ->capture(fn (FluentBuilder $fluent) => $fluent->find('http')->or->find('https'))
    ->then('://')
    ->ignoreCase();

$regex->dump();
// /^(http|https)\:\/\//i

$match = Regex::for('https://100commitow.pl/')->find('100commitow')->check();
// True
```

## Documentation

The [Fluent Regex documentation](https://rudashi.github.io/fluent-regex/) is extensive and complete, making getting
started with regular expression syntax a breeze.

## Changelog

Detailed changes for each release are documented in
the [CHANGELOG.md](https://github.com/rudashi/fluent-regex/blob/master/CHANGELOG.md).

## Credits

- [Rudashi](https://github.com/rudashi)
- [Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.