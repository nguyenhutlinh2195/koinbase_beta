FROM php:7.3-apache

RUN a2enmod remoteip

WORKDIR /var/www/html/
COPY ./src .
COPY ./apache/apache2.conf /etc/apache2/apache2.conf

# config permission
RUN chown -R root:www-data /var/www/html
RUN chmod 750 /var/www/html
RUN find . -type f -exec chmod 640 {} \;
RUN find . -type d -exec chmod 750 {} \;

# add write permission for upload file
RUN chmod g+w /var/www/html/upload/

# prevent delete
RUN chmod +t -R /var/www/html/

RUN echo "Flag 2: CBJS{day_la_fake_flag}" > /secret.txt
RUN chown root:www-data /secret.txt && chmod 440 /secret.txt;
