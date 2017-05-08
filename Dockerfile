FROM php:5-apache

RUN apt-get update && \
    apt-get install -y libpq-dev libmemcached-dev zlib1g-dev && \
    docker-php-ext-install pdo_pgsql && \
    pecl install memcache && \
    docker-php-ext-enable memcache

