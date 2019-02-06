# Germania KG · Users

**This package is distilled from legacy code.**  
You certainly will not want to use this your production code.

[![Packagist](https://img.shields.io/packagist/v/germania-kg/users.svg?style=flat)](https://packagist.org/packages/germania-kg/users)
[![PHP version](https://img.shields.io/packagist/php-v/germania-kg/users.svg)](https://packagist.org/packages/germania-kg/users)
[![Build Status](https://img.shields.io/travis/GermaniaKG/Users.svg?label=Travis%20CI)](https://travis-ci.org/GermaniaKG/Users)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GermaniaKG/Users/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Users/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/GermaniaKG/Users/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Users/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/GermaniaKG/Users/badges/build.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Users/build-status/master)


## Installation with Composer

Setup MySQL database with table creation listing in  `sql/users.sql.txt`. Use Composer for PHP:

```bash
$ composer require germania-kg/users
```

## Development

```bash
$ git clone https://github.com/GermaniaKG/Users.git
$ cd Users
$ composer install
```

## Unit tests

Either copy `phpunit.xml.dist` to `phpunit.xml` and adapt to your needs, or leave as is. Run [PhpUnit](https://phpunit.de/) test or composer scripts like this:

```bash
$ composer test
# or
$ vendor/bin/phpunit
```


## TODO

• *user_id* column name in SQL still is *client_id*. This is legacy and subject to change in upcoming major versions.
