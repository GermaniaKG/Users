# Germania KG · Users

**This package is distilled from legacy code.**  
You certainly will not want to use this your production code.

[![Build Status](https://travis-ci.org/GermaniaKG/Users.svg?branch=master)](https://travis-ci.org/GermaniaKG/Users)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GermaniaKG/Users/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Users/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/GermaniaKG/Users/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/Users/?branch=master)



## Installation

Setup MySQL database with table creation listing in  `sql/users.sql.txt`. Use Composer for PHP:

```bash
$ composer require germania-kg/users
```


## Development

```bash
$ git clone https://github.com/GermaniaKG/Users.git germania-users
$ cd germania-users
$ composer install
```

## Unit tests

Either copy `phpunit.xml.dist` to `phpunit.xml` and adapt to your needs, or leave as is.
Run [PhpUnit](https://phpunit.de/) like this:

```bash
$ vendor/bin/phpunit
```

## TODO

• *user_id* column name in SQL still is *client_id*. This is legacy and subject to change in upcoming major versions.
