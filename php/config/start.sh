#!/usr/bin/env bash

sleep 3

su-exec docker php /app/php/yii migrate/up --interactive=0
if [ $? -eq 0 ]; then
    php-fpm --fpm-config /usr/local/etc/php-fpm.conf
else
    printf "\n\n FAIL \n\n"
fi
