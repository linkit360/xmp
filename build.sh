#!/usr/bin/env bash

URL=955441867202.dkr.ecr.eu-central-1.amazonaws.com

eval $(docker-machine env -u)
docker-compose -f config/compose.common.json -f config/compose.dev.json build
if [ $? -eq 0 ]; then
    # Login
    printf "\n\n"
    eval $(aws ecr get-login --region eu-central-1 --profile=xmp)

    # Tag
    docker tag xmp_nginx:latest ${URL}/xmp/nginx:latest
    docker tag xmp_php:latest ${URL}/xmp/php:latest

    # Push
    printf "\n\n"
    docker push ${URL}/xmp/nginx:latest
    printf "\n\n"
    docker push ${URL}/xmp/php:latest
else
    printf "\n\n FAIL"
fi

printf "\n\n"
