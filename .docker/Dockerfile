FROM php:8.0-fpm

RUN apt-get update -yqq \
    && apt-get install git zip -yqq


RUN curl -Ss https://getcomposer.org/installer | php -- --filename=composer \
    && chmod a+x composer \
    && mv composer /usr/local/bin/composer

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Add custom php config
ADD custom-php.ini /usr/local/etc/php/conf.d/zz-custom-php.ini
