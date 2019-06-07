FROM php:fpm-alpine

# Apply custom php configuration
COPY conf/php.ini /usr/local/etc/php

# Install required php dependencies
RUN apk add --quiet --no-cache --virtual php-dependencies $PHPIZE_DEPS imagemagick-dev && \
    docker-php-ext-install bcmath && \
    docker-php-ext-install exif && \
    docker-php-ext-install opcache && \
    docker-php-ext-install mysqli && \
    export CFLAGS="$PHP_CFLAGS" CPPFLAGS="$PHP_CPPFLAGS" LDFLAGS="$PHP_LDFLAGS" && \
    pecl install imagick && \
    docker-php-ext-enable imagick && \
    apk add --no-cache --virtual imagemagick && \
    apk del php-dependencies
