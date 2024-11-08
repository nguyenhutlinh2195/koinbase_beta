FROM php:7.3-apache

RUN apt update
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN a2enmod remoteip

WORKDIR /var/www/html/
COPY ./src .
COPY ./apache/apache2.conf /etc/apache2/apache2.conf
# config permission
RUN chown -R root:www-data /var/www/html
RUN chmod 750 /var/www/html
RUN find . -type f -exec chmod 640 {} \;
RUN find . -type d -exec chmod 750 {} \;

RUN chmod +t -R /var/www/html/
