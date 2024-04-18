FROM php:8.2-fpm-buster

WORKDIR /var/www/src
EXPOSE 5173
RUN apt-get update && \
    apt-get install -y libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql pgsql
RUN apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN pecl install mongodb \
       && docker-php-ext-enable mongodb
