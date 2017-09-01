# Germania KG · Users

**This package is distilled from legacy code.**  
You certainly will not want to use this your production code.

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
