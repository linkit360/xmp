#!/usr/bin/env bash

#docker-machine create --driver generic --generic-ip-address=52.220.50.252 --generic-ssh-user=ubuntu --generic-ssh-key ~/xmp_cms_testing_stage.pem xmp2

eval $(docker-machine env xmp2)
if [ $? -eq 0 ]; then
    docker-compose -f ./config/compose.common.json -f ./config/compose.test.json pull
    if [ $? -eq 0 ]; then
        printf "\n\n"
        docker-compose -f ./config/compose.common.json -f ./config/compose.test.json down
        docker volume rm xmp_web-app
        docker-compose -f ./config/compose.common.json -f ./config/compose.test.json up
    else
        printf "\n\n Error: Pull \n\n"
    fi
else
    printf "\n\n Error: No Connect \n\n"
fi

eval $(docker-machine env -u)
