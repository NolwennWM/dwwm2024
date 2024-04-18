FROM php:8.2-apache
COPY . /var/www/html
# RUN apt update && apt upgrade
# RUN apt install -y libfreetype6-dev
# RUN apt update && apt upgrade && apt install -y libfreetype6-dev
RUN apt update -y && apt upgrade -y \
&& apt install -y libfreetype6-dev
ENV MA_SUPER_VARIABLE=truc