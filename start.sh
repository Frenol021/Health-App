#!/bin/sh

# Set Laravel folder permissions
chmod -R 775 storage bootstrap/cache

# Replace $PORT in nginx.conf using envsubst
if command -v envsubst > /dev/null; then
  envsubst '$PORT' < /app/config/nginx.conf > /app/config/nginx.final.conf
else
  echo "⚠️ envsubst not found, using raw nginx.conf"
  cp /app/config/nginx.conf /app/config/nginx.final.conf
fi

# Start PHP-FPM and Nginx
php-fpm -y /app/config/php-fpm.conf &
nginx -c /app/config/nginx.final.conf -g "daemon off;"
