# Start with a lightweight base image
FROM php:8.1-fpm-alpine3.15

# Set working directory
WORKDIR /var/www

# Set the current user
ARG CURRENT_USER
RUN addgroup -g 1000 $CURRENT_USER \
    && adduser -D -u 1000 -G $CURRENT_USER $CURRENT_USER

# Install system dependencies
RUN apk add --no-cache \
    build-base \
    gcc \
    autoconf \
    libxml2-dev \
    linux-headers

# Install PHP extensions
RUN docker-php-ext-install -j$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) mysqli opcache pdo_mysql xml fileinfo pdo exif

# Install additional PHP extensions with PECL
RUN pecl install xdebug \
    && docker-php-ext-enable \
    xdebug

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the current user
USER $CURRENT_USER

# Expose port 9000 for PHP-FPM
EXPOSE 9000

