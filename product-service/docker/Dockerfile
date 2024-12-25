FROM php:8.2-fpm-alpine

# Install system dependencies and PHP extensions
RUN apk add --no-cache \
    freetype-dev \
    postgresql-dev \
    git \
    zip \
    unzip \
    supervisor \
    libjpeg-turbo-dev \
    libpng-dev \
    libzip-dev \
    icu-dev \
    gmp-dev \
    libpng \
    libjpeg-turbo \
    libxpm \
    libwebp \
    icu \
    libpq \
    build-base \
    autoconf \
    libtool \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd intl pdo pdo_pgsql opcache

# Install common PHP extensions
RUN docker-php-ext-install bcmath

# Create supervisord user and group
RUN addgroup -S supervisor && adduser -S -G supervisor supervisor

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer

WORKDIR /var/www

# Copy shared component
COPY shared ./shared

# Copy composer files for caching
COPY product-service/composer.json product-service/composer.lock ./

# Copy the rest of the application
COPY product-service/. .

# Set permissions
RUN chown -R www-data:www-data /var/www

# Switch to www-data user for composer install
USER www-data

# Create and set ownership of Composer's cache directory
RUN mkdir -p /home/www-data/.composer && chown -R www-data:www-data /home/www-data/.composer

# Install dependencies
RUN composer clear-cache \
    && composer install --no-dev \
    --no-interaction \
    --optimize-autoloader \
    --prefer-dist \
    --no-scripts \
    && composer dump-autoload --optimize

# Switch back to root for subsequent operations
USER root

# Remove build tools (to reduce image size)
RUN apk del build-base autoconf libtool

# Configure opcache
COPY product-service/docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Configure PHP
COPY product-service/docker/php/php.ini /usr/local/etc/php/conf.d/custom.ini

# Configure supervisord
COPY product-service/docker/php/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copy php-fpm pool config
COPY product-service/docker/php-fpm/www.conf /usr/local/etc/php/php-fpm.d/www.conf

CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor/conf.d/supervisord.conf"]