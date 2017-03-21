#!/usr/bin/env bash

URL=955441867202.dkr.ecr.eu-central-1.amazonaws.com

# Reset to local docker
eval $(docker-machine env -u)

# Build All
docker-compose -f config/compose.common.json -f config/compose.dev.json build
if [ $? -eq 0 ]; then
    printf "\n\n"
    # Login to AWS
    eval $(aws ecr get-login --region eu-central-1 --profile=xmp)

    # Tag
    docker tag xmp/nginx:latest ${URL}/xmp/nginx:latest
    docker tag xmp/php:latest ${URL}/xmp/php:latest
    docker tag xmp/go:latest ${URL}/xmp/go:latest

    # Push
    printf "\n\n"
    docker push ${URL}/xmp/nginx:latest
    printf "\n\n"
    docker push ${URL}/xmp/php:latest
    printf "\n\n"
    docker push ${URL}/xmp/go:latest
else
    printf "\n\n FAIL BUILD"
fi

# Reset to local docker
eval $(docker-machine env -u)
printf "\n\n"
