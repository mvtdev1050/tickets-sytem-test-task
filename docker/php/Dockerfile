# docker/php/Dockerfile
FROM php:8.2-fpm

#RUN apt-get update
#RUN apt-get install -y openssl zip unzip git curl
#RUN apt-get install -y libzip-dev libonig-dev libicu-dev
#RUN apt-get install -y autoconf pkg-config libssl-dev
#RUN docker-php-ext-install bcmath mbstring intl opcache
#RUN apt-get update && apt-get install -y \
#    libcurl4-openssl-dev \
#    libssl-dev \
#    pkg-config \
#    libmongo-client-dev
#RUN apt-get install -y php8.2-mongodb 
#RUN docker-php-ext-install bcmath mbstring intl opcache
#RUN pecl install mongodb && docker-php-ext-enable mongodb
#RUN apt-get install -y php8.2-mongodb
#RUN php -m | grep mongodb

#RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini
#RUN echo "extension=mongodb.so" >> /usr/local/etc/php/php-cli.ini
#FROM php:8.2-fpm

# Update and install required packages
RUN apt-get update && apt-get install -y \
    openssl \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    libonig-dev \
    libicu-dev \
    autoconf \
    pkg-config \
    libssl-dev \
    libsasl2-dev \
    libmongoc-dev \
    libcurl4-openssl-dev

# Install PHP extensions
RUN docker-php-ext-install bcmath mbstring intl opcache

# Install MongoDB driver
RUN pecl install mongodb && docker-php-ext-enable mongodb

# Verify that MongoDB extension is installed
RUN php -m | grep mongodb

# Add the MongoDB extension configuration
RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini

