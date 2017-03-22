#!/usr/bin/env bash

eval $(docker-machine env -u)
docker-compose -f ./config/compose.common.json -f ./config/compose.dev.json down
docker-compose -f ./config/compose.common.json -f ./config/compose.dev.json up --abort-on-container-exit
