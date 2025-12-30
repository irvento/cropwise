# Multi-stage Dockerfile for Laravel with PHP-FPM and Nginx
FROM php:8.2-fpm-alpine as php-base

# Install dependencies
RUN apk add --no-cache \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    oniguruma-dev \
    icu-dev \
    postgresql-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd intl

# Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# --- Production Image ---
FROM php-base as production

# Set environment
ENV APP_ENV=production
ENV APP_DEBUG=false

# Copy existing application directory contents
COPY . /var/www

# Install production dependencies
RUN composer install --no-dev --optimize-autoloader

# Run Nginx in separate container or use a combined entrypoint
# For Render/Standard Docker, we usually use a script to start both or just FPM
CMD ["php-fpm"]
