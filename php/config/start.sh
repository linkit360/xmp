#!/usr/bin/env bash

# Composer Github Token from vostok-deploy
composer -n global config github-oauth.github.com 79fb3dea4c9cb40f32be9a4a1e09479a283a68ef

# Migrations
php /app/php/yii migrate/up --interactive=0
if [ $? != 0 ]; then
    printf "\n\n FAIL \n\n"
    exit 1
fi

# PHP-FPM Run
php-fpm --fpm-config /usr/local/etc/php-fpm.conf
