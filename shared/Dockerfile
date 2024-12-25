FROM php:8.2-fpm-alpine

WORKDIR /var/www

# Install system dependencies
RUN apk add --no-cache zip unzip git

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Install dependencies directly in the mounted volume
RUN composer install --no-dev --no-interaction --optimize-autoloader

# Set correct permissions
RUN chown -R www-data:www-data /var/www