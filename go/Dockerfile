FROM golang:1.8.0-alpine
EXPOSE 10000 10001

ENV TERM xterm
RUN apk add --progress --no-cache \
    bash wget curl nano \
    icu-libs icu-dev \
    git zip unzip zlib-dev \
    sudo su-exec openssh-client

RUN addgroup -S -g 1000 docker
RUN adduser -S -D -s /bin/bash -u 1000 -G docker docker

# SSH && CONFIG
COPY config/ /config
RUN mv /config/ssh /home/docker/.ssh
RUN cp /config/.bashrc /home/docker
RUN mv /config/.bashrc /root

RUN chown -R 1000:1000 /home/docker
RUN chmod -R 0700 /home/docker

COPY acceptor/ /go/src/acceptor

RUN chown -R 1000:1000 /go
RUN chmod -R 0700 /go

USER 1000
RUN git config --global url."git@github.com:".insteadOf "https://github.com/"

#RUN go get -u github.com/golang/dep/...

#RUN echo 8 > /tmp/tmp
#RUN go get -v github.com/linkit360/go-acceptor/server
#ENTRYPOINT server
ENTRYPOINT ["bash", "/config/idle.sh"]
