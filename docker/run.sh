#!/bin/sh

# Set default port if not provided by Render
PORT="${PORT:-80}"
echo "Starting application on port $PORT..."

# Replace PORT_PLACEHOLDER in nginx config
sed -i "s/PORT_PLACEHOLDER/$PORT/g" /etc/nginx/http.d/default.conf

# Cache configurations
echo "Caching Laravel configurations..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start PHP-FPM in the background
echo "Starting PHP-FPM..."
php-fpm -D

# Start Nginx in the foreground
echo "Starting Nginx..."
nginx -g "daemon off;"
