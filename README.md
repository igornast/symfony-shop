# Simple Symfony Shop

## First Steps
Setup and start application in dev mode
```shell script
docker-compose build
```

```shell script
docker-compose run --rm app composer install
docker-compose up
```

## Fixtures
```shell script
docker-compose exec app php bin/console d:f:loa
```

## Composer
```shell script
docker-compose exec app composer some_awesome_command
```

## PHPUnit Tests
```shell script
docker-compose exec app php vendor/bin/phpunit
```

## Access service
Api
```shell script
open http://$(docker-compose port webserver 80)/api/doc
```

PgAdmin
```shell script
open http://$(docker-compose port pma 8080)
```
