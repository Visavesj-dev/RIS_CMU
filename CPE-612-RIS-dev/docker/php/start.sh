#!/usr/bin/env bash

set -e

role=${CONTAINER_ROLE:-app}
env=${APP_ENV:-production}

if [ "$env" != "local" ]; then
    echo "Caching configuration..."
    (cd /var/www && composer install --no-dev && php artisan config:cache && php artisan route:cache && php artisan view:cache)
fi

if [ "$role" = "app" ]; then
    echo "Running App.."
    /bin/sh -c php-fpm -D | tail -f storage/logs/laravel.log

elif [ "$role" = "queue" ]; then

    echo "Running Queue.."
    php /var/www/artisan queue:work --verbose --tries=3 --timeout=90


elif [ "$role" = "scheduler" ]; then

    echo "Running Scheduler.."
    while [ true ]
    do
      php /var/www/artisan schedule:run --verbose --no-interaction &
      sleep 60
    done

else
    echo "Could not match the container role \"$role\""
    exit 1
fi