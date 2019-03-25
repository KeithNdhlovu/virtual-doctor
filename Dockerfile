FROM kndhlovu/php-base:latest

MAINTAINER Keith Ndhlovu <keith@limitlessvirtual.com>

RUN apt-get update & apt-get install zip unzip

WORKDIR /app
COPY ./ /app

# Install cloud translation client
RUN composer install

# Update the confs
RUN php artisan config:cache