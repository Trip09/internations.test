# Approach && recommendations

For this delivery I choice to go with Symfony Version 3.4 (Long term support) + Sonata Admin. This help me build a friendly interface without the need to re-invent the wheel.
There wasn't to much planning since the exercise was quit easy so nothing special in this topic. The app code is inside src/AppBundle (empty) and src/UserBundle folder and the docs on docs (Readme.md, Tests.md).

# Installation

## Minimum Requirements
### nginx
### PHP 7.1
### mysql 5.7
### composer
### make

## Test Environment
Currently the test run on dev database a process for indepentent test database should be placed.

## Production Environment
- Application Entrypoint
project/web/app.php

Run `composer install` on project folder

Parameters on
- 'project/app/config/parameters/parameters_base.yml'
- 'project/app/config/parameters/parameters_prod.yml'

Delete file:
- app_dev.php

Change Robots.txt to allow index

## Development Setup
same as production except
Parameters are:
- 'project/app/config/parameters/parameters_prod.yml'

First setup can be achieved using:

```bash
    cd project && composer install && cd ..
	project/bin/console doctrine:database:create
	project/bin/console doctrine:schema:update --force
	project/bin/console doctrine:migrations:migrate --no-interaction;
	project/bin/console doctrine:fixtures:load --no-interaction;
```

On the future your could run 

```bash
make setup-dev;
```
