FROM nginx:1.11.10-alpine
EXPOSE 80 443
ENV TERM xterm

RUN apk add --progress --no-cache \
    bash curl wget git zip unzip bc nano \
    sudo su-exec openssl certbot

# add user docker and sudo permissions for him
RUN addgroup -g 1000 docker
RUN adduser -S -D -s /bin/bash -u 1000 -G docker docker

RUN mkdir -p /etc/nginx/cert /var/cache/nginx /certs

COPY start.sh /
#COPY certs/ /etc/nginx/certs
COPY .bashrc /root
COPY .bashrc /home/docker
COPY nginx.nginx /etc/nginx/nginx.conf
COPY nginx.vh.default.nginx /etc/nginx/conf.d/default.conf

RUN touch /var/run/nginx.pid
RUN chown -R docker:docker /var/run/nginx.pid

RUN chown -R docker:docker /etc/nginx
RUN chown -R docker:docker /var/log/nginx
RUN chown -R docker:docker /var/cache/nginx
RUN chmod +x /start.sh

WORKDIR /
USER 1000
ENTRYPOINT ["bash", "/start.sh"]
