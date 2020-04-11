#!/usr/bin/env bash

ROOT_FOLDER="$(pwd)/../";

cd ${ROOT_FOLDER}
git pull

cd ${ROOT_FOLDER}/docker
docker-compose up -d

cd ${ROOT_FOLDER}/deploy
sh ./compile.sh
cd ${ROOT_FOLDER}/deploy
sh ./update.sh
cd ${ROOT_FOLDER}/deploy
sh ./migrate.sh
