#!/usr/bin/env bash


#su-exec docker php /web/php/bin/console doctrine:migrations:migrate --no-interaction
#if [ $? -eq 0 ]; then
    php-fpm --fpm-config /usr/local/etc/php-fpm.conf
#else
#    printf "\n\n FAIL \n\n"
#fi
