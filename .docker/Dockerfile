FROM php:8.0.2-fpm

COPY php.ini /usr/local/etc/php/

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    sendmail \
    mailutils \
    cron \
    && docker-php-ext-install pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /var/www/