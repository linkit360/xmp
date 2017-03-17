FROM golang:1.6.2-alpine
EXPOSE 3000
ARG PROJECT_GITHUB

ENV TERM xterm
RUN apk add --progress --no-cache \
    bash wget curl nano \
    icu-libs icu-dev \
    git zip unzip zlib-dev \
    sudo su-exec

RUN addgroup -S -g 1000 docker \
    && adduser -S -D -s /bin/bash -u 1000 -G docker docker

USER docker
WORKDIR /go



#https://scuzzlebuzzle:<MYTOKEN>@github.com/scuzzlebuzzle/ol3-1.git

#RUN mkdir /home/docker/.ssh && echo "StrictHostKeyChecking no " > /home/docker/.ssh/config
#RUN echo "[url \"git@github.com:\"]\n\tinsteadOf = https://github.com/" >> /home/docker/.gitconfig

#RUN git config --global credential.helper 'cache --timeout=3600'
#RUN git config --global user.email "8907722@gmail.com"

RUN go get Caravus:${PROJECT_GITHUB}@github.com/vostrok/acceptor

RUN ls -la /go

ENTRYPOINT /go/bin/outyet
