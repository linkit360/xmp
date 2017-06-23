#!/usr/bin/env bash

CC=$(which musl-gcc)

go build --o ./starter --ldflags '-w -linkmode external -extldflags "-static"' -v -a
if [ $? != 0 ]; then
    printf "\n\n FAIL \n\n"
    exit 1
fi

mv ./starter ../../../php/config/start
