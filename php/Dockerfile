FROM php:7.1.3-fpm-alpine

EXPOSE 9000
ENV TERM xterm

# Deps
RUN apk add --progress --no-cache \
    bash wget curl nano \
    icu-libs icu-dev \
    git zip unzip zlib-dev \
    openssl libmcrypt-dev libxml2-dev \
    sudo su-exec postgresql-dev

# PHP Ext
RUN docker-php-ext-install opcache mbstring pdo pdo_pgsql json intl sockets mcrypt iconv zip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add Group and User
RUN addgroup -S -g 1000 docker
RUN adduser -S -D -s /bin/bash -u 1000 -G docker docker

# Configs
COPY config/ /app/config
RUN mv /app/config/php.ini /usr/local/etc/php-fpm.conf
RUN mv /app/config/php-www.ini /usr/local/etc/php-fpm.d/www.conf
RUN cp /app/config/.bashrc /home/docker
RUN mv /app/config/.bashrc /root

COPY composer/ /app/composer
COPY app/ /app/php

RUN chown -R 1000:1000 /app
RUN chmod -R 0700 /app
WORKDIR /app/php

# REMEMBER: only RUN under non-root USER, not COPY
USER 1000
RUN composer -n global require --prefer-dist "hirak/prestissimo:^0.3"
RUN composer -n global require --prefer-dist "fxp/composer-asset-plugin:^1.2.0"
ENTRYPOINT ["bash", "/app/config/start.sh"]
