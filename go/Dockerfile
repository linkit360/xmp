FROM golang:1.8.3-alpine AS build-env

RUN apk add --progress --no-cache bash curl nano git openssh-client

# SSH && CONFIG
COPY ssh/ /root/.ssh
RUN git config --global url."git@github.com:".insteadOf "https://github.com/" \
    && mkdir -p /go/bin \
    && mkdir -p /go/src \
    && chown -R root:root /root \
    && chmod -R 0700 /root/.ssh

# Get src
RUN echo 228
RUN go get -v -u github.com/linkit360/xmp-api/src/server
COPY server.go /go/src/github.com/linkit360/xmp-api

# Build from src
RUN cd /go/src/github.com/linkit360/xmp-api \
    && rm main.go \
    && go build -o /go/bin/server

# Real golang
FROM golang:1.8.3-alpine

RUN apk add --progress --no-cache bash curl nano git openssh-client

ENV TERM xterm
EXPOSE 2082 50318 50319

# Add Group, User, dirs
RUN set -ex \
    && addgroup -S -g 1000 docker \
    && adduser -S -D -s /bin/bash -u 1000 -G docker docker \
    && mkdir -p /go/bin \
    && mkdir -p /go/src

# SSH && CONFIG
COPY config/ /config
RUN set -ex \
    && cp /config/.bashrc /home/docker \
    && mv /config/.bashrc /root \
    && chown -R 1000:1000 /home/docker \
    && chmod -R 0700 /home/docker

# Bin
COPY --from=build-env /go/bin/server /go/bin/server

USER 1000
WORKDIR /go/src/github.com/linkit360/xmp-api
ENTRYPOINT ["bash", "/config/start.sh"]
