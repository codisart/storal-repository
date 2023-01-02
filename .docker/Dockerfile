FROM php:8.0-fpm

RUN apt-get update -yqq \
    && apt-get install git zip libpq-dev libicu-dev -yqq \
    && apt-get clean

RUN curl -Ss https://getcomposer.org/installer | php -- --filename=composer \
    && chmod a+x composer \
    && mv composer /usr/local/bin/composer

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo pdo_pgsql pgsql intl

# Add custom php config
ADD custom-php.ini /usr/local/etc/php/conf.d/zz-custom-php.ini
