#!/bin/sh

# Ensure Laravel has proper permissions
chmod -R 775 storage bootstrap/cache

# Replace $PORT in nginx.conf
envsubst '$PORT' < /app/config/nginx.conf > /app/config/nginx.final.conf

# Start PHP-FPM and Nginx
php-fpm -y /app/config/php-fpm.conf &
nginx -c /app/config/nginx.final.conf -g "daemon off;"
