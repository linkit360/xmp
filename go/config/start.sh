#!/usr/bin/env bash

if [ "${PROJECT_ENV}" = "development" ]
then
    echo "This is a idle script (infinite loop) to keep container running."
    echo "Please replace this script."


    mv /config/ssh /home/docker/.ssh
    git config --global url."git@github.com:".insteadOf "https://github.com/"


    cleanup ()
    {
      kill -s SIGTERM $!
      exit 0
    }

    trap cleanup SIGINT SIGTERM

    while [ 1 ]
    do
      sleep 60 &
      wait $!
    done
fi

/go/bin/acceptor
