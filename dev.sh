#!/bin/bash
# set -x
[ -f .env ] || cp .env.example .env

source .env &> /dev/null
[ "$APP_ENV" = "dev" ] && docker_option="-d"

[ "$1" = "stop" ] && echo "stopping docker ..." && docker-compose stop && exit

[ -d vendor ] || {
    winpty="$( docker-compose exec -it app bash -c ':' &> /dev/null && echo '' ||  echo 'winpty -Xallow-non-tty' )"
    echo "docker-compose up -d --build ..." && \
    docker-compose up -d --build && \
    echo "composer install ..." && \
    $winpty docker-compose exec app bash -c "COMPOSER_MEMORY_LIMIT=-1 composer install"
}

docker-compose up $docker_option
