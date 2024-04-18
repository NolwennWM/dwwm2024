FROM php:8.2-apache
RUN apt -y update && apt -y upgrade
RUN apt install -y libfreetype6-dev \
&& docker-php-ext-configure gd --with-freetype=/usr/include/freetype2/ \
&& docker-php-ext-install pdo_mysql gd
RUN apt install -y libcurl4-openssl-dev pkg-config libssl-dev
RUN pecl install mongodb && docker-php-ext-enable mongodb \
&& echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/ext-mongodb.ini
RUN a2enmod rewrite
# COPY . /var/www/html
EXPOSE 80