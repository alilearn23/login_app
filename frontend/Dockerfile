FROM php:8.0-apache

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

COPY . /var/www/html/

USER 1000

EXPOSE 80

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]