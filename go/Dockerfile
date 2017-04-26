FROM golang:1.8.1-alpine
EXPOSE 3000 50318 50319

ENV TERM xterm
RUN apk add --progress --no-cache bash wget curl nano git openssh-client

RUN addgroup -S -g 1000 docker
RUN adduser -S -D -s /bin/bash -u 1000 -G docker docker

USER 1000
RUN curl https://glide.sh/get | sh
USER root

# SSH && CONFIG
COPY config/ /config
RUN mv /config/ssh /home/docker/.ssh
RUN cp /config/.bashrc /home/docker
RUN mv /config/.bashrc /root

RUN chown -R 1000:1000 /home/docker
RUN chmod -R 0700 /home/docker

# Vendor
RUN mkdir -p /go/src/acceptor/vendor
COPY src/acceptor/vendor /go/src/acceptor/vendor
COPY src/acceptor/glide.lock /go/src/acceptor
COPY src/acceptor/glide.yaml /go/src/acceptor
COPY src/acceptor/client.go /go/src/acceptor
COPY src/acceptor/main.go /go/src/acceptor
COPY src/acceptor/src /go/src/acceptor/src
RUN chown -R 1000:1000 /go/src/acceptor && chmod -R 0700 /go/src/acceptor

WORKDIR /go/src
USER 1000
RUN git config --global url."git@github.com:".insteadOf "https://github.com/"

#ENTRYPOINT server
ENTRYPOINT ["bash", "/config/idle.sh"]
