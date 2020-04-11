#!/usr/bin/env bash

ROOT_FOLDER="$(pwd)/../";

cd ${ROOT_FOLDER}
git pull

cd ${ROOT_FOLDER}/docker
docker-compose exec console rm -rf /var/www/html/storage/framework/views/cache/*
docker-compose exec console rm -rf /var/www/html/storage/framework/views/compile/*
docker-compose exec console chown www-data:www-data -R /var/www/html/storage
docker-compose exec console composer install --no-dev
docker-compose exec console composer dump-autoload
docker-compose restart console php-fpm
