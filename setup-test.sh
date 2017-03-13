#!/usr/bin/env bash

eval $(docker-machine env aws02)
docker-compose -f ./config/compose.common.json -f ./config/compose.test.json pull
if [ $? -eq 0 ]; then
    printf "\n\n"
    docker-compose -f ./config/compose.common.json -f ./config/compose.test.json down
    docker volume rm xmp_web-app
    docker-compose -f ./config/compose.common.json -f ./config/compose.test.json up -d
else
    printf "\n\n FAIL \n\n"
fi

eval $(docker-machine env -u)
