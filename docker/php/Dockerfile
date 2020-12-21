FROM php:7.4.9-fpm-buster

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && \
    apt-get install zip unzip && \
    rm -rf /var/lib/apt/lists/*

RUN apt-get update && \
  apt-get install -y libxml2-dev && \
  docker-php-ext-install soap && \
  rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
    pdo pdo_mysql \
    sockets \
    bcmath \
    fileinfo \
    gettext \
    json

WORKDIR /var/www/platform/current
