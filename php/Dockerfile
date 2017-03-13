FROM php:7.1.2-fpm-alpine

EXPOSE 9000
ARG PROJECT_GITHUB

# ENV
ENV TERM xterm
RUN apk add --progress --no-cache \
    bash wget curl nano \
    icu-libs icu-dev \
    git zip unzip zlib-dev \
    openssl libmcrypt-dev libxml2-dev \
    sudo su-exec postgresql-dev

RUN addgroup -S -g 1000 docker \
    && adduser -S -D -s /bin/bash -u 1000 -G docker docker

# PHP
RUN docker-php-ext-install mbstring pdo pdo_mysql pdo_pgsql json intl sockets mcrypt iconv zip tokenizer xml calendar
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configs
COPY config/ /app/config
RUN mv /app/config/php.ini /usr/local/etc/php-fpm.conf
RUN mv /app/config/php-www.ini /usr/local/etc/php-fpm.d/www.conf
RUN cp /app/config/.bashrc /home/docker
RUN mv /app/config/.bashrc /root

# REMEMBER: only RUN under USER, not COPY
USER 1000
RUN composer -n global config github-oauth.github.com ${PROJECT_GITHUB}
RUN composer -n global require --prefer-dist "hirak/prestissimo:^0.3"
RUN composer -n global require --prefer-dist "fxp/composer-asset-plugin:^1.2.0"
USER root

EXPOSE 50313 50315

COPY composer/ /app/composer
COPY app/ /app/php

RUN chown -R docker:docker /app
RUN chmod -R 0700 /app

WORKDIR /app/php
ENTRYPOINT ["bash", "/app/config/start.sh"]
