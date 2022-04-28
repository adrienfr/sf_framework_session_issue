# Reproducer session issue

## Test

```bash
composer install
php bin/console --env=test doctrine:database:create
php bin/console --env=test doctrine:schema:create
php bin/phpunit
```

Update composer.json with `"symfony/http-kernel": "5.4.7",` / `"symfony/http-kernel": "5.4.8",` to switch between SF versions.

On SF 5.4.7 :
```bash

WARNINGS!
Tests: 2, Assertions: 3, Warnings: 1.
```

On SF 5.4.8 :
```bash

FAILURES!
Tests: 2, Assertions: 3, Failures: 1, Warnings: 1.
```
