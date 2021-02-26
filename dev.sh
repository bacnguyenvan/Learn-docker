#!/bin/bash
# set -x
[ -f .env ] || cp .env.example .env
[ -d vendor ] || {
    docker-compose up -d --build && \
    docker-compose exec app bash -c "COMPOSER_MEMORY_LIMIT=-1 composer install"
}

docker-compose up
