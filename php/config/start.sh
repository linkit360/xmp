#!/usr/bin/env bash

# Composer Github Token
composer -n global config github-oauth.github.com ${PROJECT_GITHUB}

# Migrations
php /app/php/yii migrate/up --interactive=0
if [ $? != 0 ]; then
    printf "\n\n FAIL \n\n"
    exit 1
fi

# PHP-FPM Run
php-fpm --fpm-config /usr/local/etc/php-fpm.conf
