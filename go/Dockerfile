FROM golang:1.8.1-alpine

RUN apk add --progress --no-cache bash curl nano git

ENV TERM xterm
EXPOSE 2082 50318 50319

# Add Group, User, dirs
RUN set -ex \
    && addgroup -S -g 1000 docker \
    && adduser -S -D -s /bin/bash -u 1000 -G docker docker \
    && mkdir -p /go/bin \
    && mkdir -p /go/src

# Glide (vendoring)
USER 1000
RUN curl https://glide.sh/get | sh
USER root

# SSH && CONFIG
COPY config/ /config
RUN set -ex \
    && cp /config/.bashrc /home/docker \
    && mv /config/.bashrc /root \
    && chown -R 1000:1000 /home/docker \
    && chmod -R 0700 /home/docker

COPY bin /go/bin
RUN chmod -R +x /go/bin/*

USER 1000
WORKDIR /go/src

ENTRYPOINT ["bash", "/config/start.sh"]
