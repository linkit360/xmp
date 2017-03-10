#!/usr/bin/env bash

eval $(docker-machine env -u)
docker-compose -f config/compose.common.json -f config/compose.dev.json build
printf "\n\n"
