# Dockerfile for Product Service
FROM php:8.2-fpm

# Install system dependencies and required libraries
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        netcat-openbsd \
        net-tools \
        iproute2 \
        build-essential \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libicu-dev \
        libpq-dev \
        libzip-dev \
        libgmp-dev \
        zlib1g-dev \
        libonig-dev \
        libxml2-dev \
        git \
        unzip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install required PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) \
        gd \
        intl \
        mbstring \
        pdo \
        pdo_pgsql \
        zip \
        bcmath

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Create user and group for php-fpm
RUN set -ex; \
    if ! getent group www-data; then groupadd -g 1000 www-data; fi; \
    if ! getent passwd www-data; then useradd -u 1000 -ms /bin/bash -g www-data www-data; fi

# Copy application source code
COPY . /var/www/
WORKDIR /var/www

ENV COMPOSER_ALLOW_SUPERUSER=1

# Install PHP dependencies
RUN composer clear-cache && composer install --no-dev --optimize-autoloader --prefer-dist

# Ensure proper file permissions
RUN chown -R www-data:www-data /var/www

RUN mkdir -p /run/php && chown www-data:www-data /run/php

RUN mkdir -p /var/log/php-fpm && chown www-data:www-data /var/log/php-fpm && chmod 755 /var/log/php-fpm

COPY php-fpm/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY php-fpm/php-fpm.conf /usr/local/etc/php-fpm.conf

# Expose PHP-FPM port
EXPOSE 9002

# Start PHP-FPM
CMD ["php-fpm", "-F"]
