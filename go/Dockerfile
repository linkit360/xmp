FROM golang:1.6.2-alpine
EXPOSE 3000 50313 50314

ENV TERM xterm
RUN apk add --progress --no-cache \
    bash wget curl nano \
    icu-libs icu-dev \
    git zip unzip zlib-dev \
    sudo su-exec openssh-client

RUN addgroup -S -g 1000 docker \
    && adduser -S -D -s /bin/bash -u 1000 -G docker docker

# SSH && CONFIG
COPY ssh /home/docker/.ssh
COPY config/ /go/bin/config
RUN git config --global url."git@github.com:".insteadOf "https://github.com/"

RUN cp /go/bin/config/.bashrc /home/docker
RUN mv /go/bin/config/.bashrc /root

RUN chown -R 1000:1000 /home/docker && chmod -R 0700 /home/docker
RUN chown -R 1000:1000 /go && chmod -R 0700 /go

WORKDIR /go/bin
USER docker
RUN echo 4 > /tmp/tmp
RUN go get -v github.com/linkit360/go-acceptor/server
ENTRYPOINT server
