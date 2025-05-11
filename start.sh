#!/bin/sh

# Replace $PORT in nginx.conf
envsubst '$PORT' < /app/config/nginx.conf > /app/config/nginx.final.conf

# Start PHP and Nginx
php-fpm -y /app/config/php-fpm.conf &
nginx -c /app/config/nginx.final.conf -g "daemon off;"
