FROM php:7-fpm-alpine

# Apply custom php configuration
COPY conf/php.ini /usr/local/etc/php

# Install required php dependencies
RUN apk add --quiet --no-cache --virtual php-dependencies freetype-dev libjpeg-turbo-dev libpng-dev && \
    docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/ && \
    docker-php-ext-install gd opcache mysqli && \
    apk del php-dependencies
