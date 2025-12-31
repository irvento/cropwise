#!/bin/sh

# Cache configurations
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations (ensure DB is ready)
# Skip if not needed or run manually via Render's dashboard shell
# php artisan migrate --force

# Start Nginx
nginx -g "daemon off;" &

# Start PHP-FPM
php-fpm
