#!/usr/bin/env bash

ROOT_FOLDER="$(pwd)/../";

cd ${ROOT_FOLDER}/docker
docker-compose exec console vendor/bin/doctrine orm:schema-tool:create
docker-compose exec console vendor/bin/doctrine orm:schema-tool:update --force
docker-compose exec console php cli.php database:seed
