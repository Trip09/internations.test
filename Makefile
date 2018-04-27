help:
	@echo "do a cat!"

install:
	composer install;
	make cache;

setup-dev:
	project/bin/console doctrine:database:drop --force
	project/bin/console doctrine:database:create
	project/bin/console doctrine:schema:update --force
	project/bin/console doctrine:migrations:migrate --no-interaction;
	project/bin/console doctrine:fixtures:load --no-interaction;

null:
#	mysql -uroot -hiyp.mysql < project/app/DoctrineMigrations/struct.sql;
#	project/bin/console doctrine:migrations:migrate --no-interaction;
#	project/bin/console doctrine:fixtures:load --no-interaction;

assets:
	project/bin/console assets:install --symlink
	project/bin/console assetic:dump

cache:
	project/bin/console cache:clear
	project/bin/console cache:warmup

debug:
	export PHP_IDE_CONFIG="serverName=internations.test.localhost"

cs:
	php-cs-fixer fix --verbose

cs_dry_run:
	php-cs-fixer fix --verbose --dry-run

up:
	composer install --dev
	make cache

tests:
	make unit

unit:
	./project/vendor/bin/phpunit

unit-coverage:
	./project/vendor/bin/phpunit --coverage-html build/coverage/phpunit
