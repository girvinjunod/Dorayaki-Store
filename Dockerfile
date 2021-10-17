FROM php:8.0-cli
COPY . /var/www/html
WORKDIR /var/www/html
EXPOSE 8000
CMD ["php", "-S", "0.0.0.0:8000"]
