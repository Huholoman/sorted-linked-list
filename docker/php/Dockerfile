FROM php:8.2-cli

RUN \
    apt-get update && \
    apt-get install -y

RUN \
    pecl install xdebug && \
    docker-php-ext-enable xdebug


RUN \
    usermod -u 1000 www-data && \
    groupmod -g 1000 www-data && \
    usermod -d /home/www-data -s /bin/bash www-data

RUN \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    chmod +x /usr/local/bin/composer && \
    chown www-data:www-data /usr/local/bin/composer

USER www-data

WORKDIR /app
