### Hexlet tests and linter status:
[![Actions Status](https://github.com/KebogdBP/php-project-48/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/KebogdBP/php-project-48/actions)

# php-package

[![Actions Status](https://github.com/KebogdBP/php-project-48/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/KebogdBP/php-project-48/actions)
[![Github Actions Status](https://github.com/KebogdBP/php-project-48/actions/workflows/ci.yml/badge.svg)](https://github.com/KebogdBP/php-project-48/actions)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=KebogdBP_php-project-48&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=KebogdBP_php-project-48)
[![Bugs](https://sonarcloud.io/api/project_badges/measure?project=KebogdBP_php-project-48&metric=bugs)](https://sonarcloud.io/summary/new_code?id=KebogdBP_php-project-48)
[![Code Smells](https://sonarcloud.io/api/project_badges/measure?project=KebogdBP_php-project-48&metric=code_smells)](https://sonarcloud.io/summary/new_code?id=KebogdBP_php-project-48)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=KebogdBP_php-project-48&metric=coverage)](https://sonarcloud.io/summary/new_code?id=KebogdBP_php-project-48)
[![Duplicated Lines (%)](https://sonarcloud.io/api/project_badges/measure?project=KebogdBP_php-project-48&metric=duplicated_lines_density)](https://sonarcloud.io/summary/new_code?id=KebogdBP_php-project-48)

# gendiff — Generate Diff Utility

Утилита для сравнения двух конфигурационных файлов и вывода их различий.

## Prerequisites

* Linux, Macos, WSL
* PHP >= 8.1
* Xdebug
* Make
* Git
* Composer

## Setup

Setup [SSH](https://docs.github.com/en/authentication/connecting-to-github-with-ssh) before clone:

```bash
git clone git@github.com:KebogdBP/php-project-48.git
cd php-project-48

make install
```

## Usage

```bash
gendiff (-h|--help)
gendiff (-v|--version)
gendiff [--format <fmt>] <firstFile> <secondFile>
```

### Example

```bash
./bin/gendiff file1.json file2.json

{
  - follow: false
    host: hexlet.io
  - proxy: 123.234.53.22
  - timeout: 50
  + timeout: 20
  + verbose: true
}
```

## Run linter

```sh
make lint
```

See configs [phpcs.xml](./phpcs.xml) and [phpstan.neon](./phpstan.neon)

## Run tests

```sh
make test
```

## Test Coverage

```sh
make test-coverage-text
```

* See `phpunit.xml`
* See [sonarcloud documentation](https://docs.sonarsource.com/sonarqube-cloud/enriching/test-coverage/php-test-coverage/)
* Add `SONAR_TOKEN` to workflow as SECRETS ENV VARIABLE (for safety)

## Аскинема — пример работы gendiff
здесь будет пример работы аскинемы
