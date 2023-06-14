FROM php:8.0.2-fpm

RUN apt-get update && apt-get install -y \
    build-essential \
    libonig-dev \
    libcurl4-openssl-dev \
    libssl-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    curl \
    git \
    supervisor

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# php.ini
COPY ./php/php.ini /usr/local/etc/php/php.ini

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin

# Laravel
WORKDIR /var/www/html
RUN composer global require "laravel/installer"