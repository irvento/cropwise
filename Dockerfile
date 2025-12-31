# Base stage for PHP dependencies
FROM php:8.2-fpm-alpine as vendor

# Install system dependencies
RUN apk add --no-cache \
    bash \
    curl \
    libpng-dev \
    libzip-dev \
    zlib-dev \
    icu-dev \
    oniguruma-dev \
    postgresql-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libwebp-dev

# Configure extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp

# Install PHP extensions
RUN docker-php-ext-install -j$(nproc) \
    gd \
    zip \
    bcmath \
    intl \
    pdo_pgsql \
    mbstring \
    opcache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy only composer files initially for better caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# Copy the rest of the application
COPY . .
RUN composer dump-autoload --optimize

# ---
# Intermediate stage for Node/NPM dependencies and building assets
FROM node:20-alpine as frontend

WORKDIR /var/www/html

COPY package.json package-lock.json ./
RUN npm ci

COPY . .
RUN npm run build

# ---
# Final production stage
FROM php:8.2-fpm-alpine

# Install Nginx and runtime/build dependencies
RUN apk add --no-cache \
    nginx \
    bash \
    libpng-dev \
    libzip-dev \
    zlib-dev \
    icu-dev \
    oniguruma-dev \
    postgresql-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    icu-libs \
    postgresql-libs

# Configure extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp

# Install PHP extensions for runtime
RUN docker-php-ext-install -j$(nproc) \
    gd \
    zip \
    bcmath \
    intl \
    pdo_pgsql \
    mbstring \
    opcache

WORKDIR /var/www/html

# Copy from previous stages
COPY --from=vendor /var/www/html /var/www/html
COPY --from=frontend /var/www/html/public/build /var/www/html/public/build

# Copy configuration files
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
COPY docker/run.sh /usr/local/bin/run.sh

# Ensure script is executable
RUN chmod +x /usr/local/bin/run.sh

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 80

# Start the application
CMD ["/usr/local/bin/run.sh"]
