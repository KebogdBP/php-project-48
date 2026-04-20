install:
	composer install

.PHONY:
	install

console:
	composer exec --verbose psysh

lint:
	composer exec --verbose phpcs -- --warning-severity=0 src tests
	composer exec --verbose phpstan -- --memory-limit=256M
	composer exec --verbose phpcs -- --standard=PSR12 src bin

lint-fix:
	composer exec --verbose phpcbf -- src tests

test:
	composer exec --verbose phpunit tests

test-coverage:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --coverage-clover=build/logs/clover.xml

test-coverage-text:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --coverage-text

gendiff -h:
	 ./bin/gendiff -h

asciinema:
	asciinema rec
