FROM php:5.6-apache

COPY ./php.ini /usr/local/etc/php/conf.d/

COPY ./virtualhost.conf /etc/apache2/sites-available/000-default.conf

RUN docker-php-ext-install mysqli
