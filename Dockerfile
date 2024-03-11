FROM php:8.2-fpm

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Configure Xdebug
RUN echo "xdebug.mode=develop,debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini