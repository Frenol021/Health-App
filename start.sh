#!/bin/sh

# Start PHP and Nginx
php-fpm -y /app/config/php-fpm.conf &
nginx -c /app/config/nginx.conf -g "daemon off;"
