FROM php:8.2-apache
RUN apt update -y && apt upgrade -y \
&& docker-php-ext-install pdo_mysql
EXPOSE 80