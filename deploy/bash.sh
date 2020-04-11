#!/usr/bin/env bash

ROOT_FOLDER="$(pwd)/../";

cd ${ROOT_FOLDER}/docker
docker-compose exec console bash
