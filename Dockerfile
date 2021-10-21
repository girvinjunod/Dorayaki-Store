FROM php:8.0-apache
COPY ./ /var/www/html
WORKDIR /var/www/html
RUN chown www-data:www-data ./db
RUN chown www-data:www-data ./db/doraemon.db
RUN chmod 777 ./db/img
